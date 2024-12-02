<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    // Vulnerable to SQL Injection
    public function searchVulnerable(Request $request)
    {
        $query = $request->input('q', '');
        // Raw query concatenation - VERY vulnerable!
        $sql = "SELECT id, name, description, price FROM products WHERE name = '$query'";
        
        try {
            $results = DB::select($sql);
            return view('test.search', [
                'results' => $results, 
                'sql' => $sql,
                'error' => null
            ]);
        } catch (\Exception $e) {
            return view('test.search', [
                'results' => [], 
                'sql' => $sql,
                'error' => $e->getMessage()
            ]);
        }
    }

    // Vulnerable to XSS
    public function commentVulnerable(Request $request)
    {
        $comment = $request->input('comment');
        // Purposely not escaping the comment
        return view('test.comment', ['comment' => $comment]);
    }

    // Vulnerable to SQL Injection
    public function userVulnerable($id)
    {
        // Purposely vulnerable query
        $user = DB::select("SELECT * FROM users WHERE id = " . $id);
        return view('test.user', ['user' => $user]);
    }

    // Vulnerable to XSS in product review
    public function reviewVulnerable(Request $request)
    {
        $review = $request->input('review');
        // Purposely storing unescaped content
        DB::table('reviews')->insert([
            'content' => $review,
            'product_id' => $request->input('product_id'),
            'created_at' => now()
        ]);
        return redirect()->back();
    }

    // New vulnerable endpoint specifically for SQL injection demo
    public function userSearchVulnerable(Request $request)
    {
        $query = $request->input('q');
        // Extremely vulnerable query
        $results = DB::select("SELECT * FROM users WHERE name = '" . $query . "'");
        return view('test.user_search', ['results' => $results]);
    }
}
