<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Book;

class AdminController extends Controller
{
    public function index(){
        return view('admin/index', ['list' => Book::all()]);
    }

    public function LogIn(){
        return view('admin/logIn');
    }

    public function auth(Request $request){
        $validated = $request->validate([
            'login' => ['required'],
            'password' => ['required']
        ]);

        if(Auth::guard('admin')->attempt(['login' => $request->login, 'password' => $request->password])){
            session(['admin'=> $request->login]);
            return response()->json(['message' => 'success'], 200);
        }
        else{
            return response()->json(['message' => 'wrong login or password'], 422);
        }

    }

    public function logout(){
        if(session('admin')){
            session()->forget('admin');
            return redirect()->route('logIn');
        }
        else{
            return redirect('/');
        }
    } 

    public function edit($isbn){

        $bookInfo = Book::where('isbn', $isbn)->first();

        if($bookInfo!==null){
            return view('admin/edit', ['bookInfo'=> $bookInfo]); 
        }
        else{
           return redirect('/index');
        }
    }

    public function update(Request $request){
        $validated = $request->validate([
            'title' => ['required'],
            'author' => ['required'],
            'publication_year' => ['required', 'integer'],
            'publisher' => ['required'],
            'oldIsbn' => ['required'],
            'isbn' => ['required']
        ]);

        $pattern = '/^978-\d{1}-\d{4}-\d{4}-\d{1}+$/';

        if(!preg_match($pattern, $request->isbn)){
            return response()->json(['message' => 'Wrong ISBN code'], 422);
        }

        $bookInfo = Book::where('isbn', $request->oldIsbn)->first();
        
        if($bookInfo!==null){

            $publicationYear = intval($request->input('publication_year'));
            $updatedData = Book::where('isbn', $request->oldIsbn)->update([
                'title' => $request->title,
                'author' => $request->author,
                'publication_year' => $publicationYear,
                'publisher' => $request->publisher,
                'isbn' => $request->isbn
            ]);

            return response()->json(['message' => 'Data was successfully updated'], 200);
        }
        else{
            return response()->json(['message' => 'Book not found'], 422);
        }
    }

    public function addBook(){
        return view('admin/add');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title' => ['required'],
            'author' => ['required'],
            'publication_year' => ['required', 'integer'],
            'publisher' => ['required'],
            'isbn' => ['required', 'unique:books,isbn']
        ]);

        $pattern = '/^978-\d{1}-\d{4}-\d{4}-\d{1}+$/';

        if(!preg_match($pattern, $request->isbn)){
            return response()->json(['message' => 'Wrong ISBN code'], 422);
        }

        if($request->publication_year < 0 || $request->publication_year > date('Y')){
            return response()->json(['message' => 'Incorrect year'], 422);
        }

        $book = Book::where('isbn', $request->isbn)->first();

        if($book!==null){
            return response()->json(['message' => 'Such book allready exists'], 422);
        }
        else{
            $publicationYear = intval($request->input('publication_year'));

            $newBook = new Book();
            $newBook->title = $request->title;
            $newBook->author = $request->author;
            $newBook->publication_year = $publicationYear;
            $newBook->publisher = $request->publisher;
            $newBook->isbn = $request->isbn;

            $newBook->save();

            return response()->json(['message' => 'Book was successfully added'], 200);
        }
    }

    public function destroy($isbn){
        Book::where('isbn', $isbn)->delete();

        return response()->json(['message'=> 'Book deleted successfully'], 200);
    }

    public function filter($filterType){
        $filteredList = Book::orderBy($filterType, 'desc')->get();

        if($filteredList!==null){
            return response()->json(['list' => $filteredList]);
        }
        else{
            return response()->json(['message' => 'Something went wrong'], 422);
        }
    }
}
