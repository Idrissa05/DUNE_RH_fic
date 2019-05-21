<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConjointController extends Controller {


  public function index(Request $request)
  {
      if($request->ajax()) {
          return [];
      }
      return view('pages.agents.conjoints.index');

  }


  public function create()
  {

  }


  public function store()
  {

  }


  public function show($id)
  {

  }


  public function edit($id)
  {

  }


  public function update($id)
  {

  }


  public function destroy($id)
  {

  }

}
