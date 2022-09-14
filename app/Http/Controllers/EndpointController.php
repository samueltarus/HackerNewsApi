<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;


use GuzzleHttp\Message\Response;

class EndpointController extends Controller
{



    // 2. Top 10 most occurring words in the titles of the post of exactly the last week
    public function OccuringWordsTitlesInlastweek()
    {
        $request = Http::get('https://hacker-news.firebaseio.com/v0/topstories.json?print=pretty');
        $data = $request->json();
        $items = array_slice($data, -20);

        $titleArray = [];
        $x = 0;

        foreach ($items as $res) {
            $story = Http::get("https://hacker-news.firebaseio.com/v0/item/" . $res . ".json?print=pretty");

            $dataresp[] = json_decode($story, true);
            $title = $dataresp[$x]['title'];
            $titleArray[$x] = $title;
            $x = $x + 1;
        }
        $titleList = array_slice($titleArray, 10);

        return $titleList;

        return $titleArray;
    }

    // 3. Top 10 most occurring words in titles of the last 600 stories of users with at least 10.000 karma 
    public function OccuringWordsTitlesInlastUsersWithKarma()
    {
        $request = Http::get('https://hacker-news.firebaseio.com/v0/user/jl.json?print=pretty');
        $data = $request->json();
        $items = array_slice($data, -20);

        $titleArray = [];
        $x = 0;

        foreach ($items as $res) {
            $story = Http::get("https://hacker-news.firebaseio.com/v0/item/" . $res . ".json?print=pretty");

            $dataresp[] = json_decode($story, true);
            $title = $dataresp[$x]['title'];
            $titleArray[$x] = $title;
            $x = $x + 1;
        }
        $titleList = array_slice($titleArray, 10);

        return $titleList;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // 1. Top 10 most occurring words in the titles of the last 25 stories

    public function index()
    {
        //fecth  all data ids
        $request = Http::get('https://hacker-news.firebaseio.com/v0/topstories.json?print=pretty');
        $data = $request->json();
        // filter the last 25 stories
        $items = array_slice($data, -20);

        $titleArray = [];
        $x = 0;
        // loop on each to get themost occuring words


        foreach ($items as $res) {
            $story = Http::get("https://hacker-news.firebaseio.com/v0/item/" . $res . ".json?print=pretty");
            $dataresp[] = json_decode($story, true);
            $title = $dataresp[$x]['title'];
            $titleArray[$x] = $title;
            $x = $x + 1;
        }

        $data = array();
        foreach ($titleArray as $sentence) {
            //gatering words in an array by spliting the sentence on space.
            $data =  array_merge($data, explode(" ", $sentence));
        }
        //counting values present in array for case sensitive
        $result = array_count_values($data);

        //counting values present in array for case insensitive by changing each array element to lowercase
        $result = array_count_values(array_map("strtolower", $data));  
        arsort($result);      
        // arsort($result);  

        // $titleList = array_slice($result, 10);   

        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
