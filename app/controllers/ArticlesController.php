<?php

class ArticlesController extends \BaseController {

	/**
	 * Display a listing of articles
	 *
	 * @return Response
	 */
	public function index()
	{
	    return Article::all();
	}

	/**
	 * Store a newly created article in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Article::$rules);

		if ($validator->fails())
		{
			return ['errors' => $validator->messages()];
		}

		$article = Article::create($data);

		return $article;
	}

	/**
	 * Display the specified article.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$article = Article::findOrFail($id);

		return $article;
	}

	/**
	 * Show the form for editing the specified article.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$article = Article::find($id);

		return $article;
	}

	/**
	 * Update the specified article in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$article = Article::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Article::$rules);

		if ($validator->fails())
		{
			return ['errors' => $validator->messages()];
		}

		$article->update($data);

		return $article;
	}

	/**
	 * Remove the specified article from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Article::destroy($id);

		return ['status' => 1];
	}

}
