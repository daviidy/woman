<?php

namespace App\Http\Controllers;

use App\Woman;
use Illuminate\Http\Request;
use Image;

class WomanController extends Controller
{
    /**
     * Display a listing of the resource.
     *affiche toutes les plus belles femmes du monde
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      /**demander au modèle de nous donner la liste de toutes les femmes
      *et stocker le resultat dans la variable $woment
      */
        $women = Woman::orderBy('name', 'asc')->paginate(9);
        return view('women.index', ['women' => $women]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('women.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      //on verifie que toutes les données recues sont valides
      //avant de les enregistrer
      /*$this->validate($request, [
        'name' => 'bail|required|unique|max:255',
        'website' => 'bail|required',
        'city' => 'bail|required',
      ]);*/
      //l'objet $request contient toutes les datas post venant
      //du formulaire, et nous le passons à la methode create() sur
      //la classe Woman

      $woman = Woman::create($request->all());

      if($request->hasFile('image')){
    		$image = $request->file('image');
    		$filename = time() . '.' . $image->getClientOriginalExtension();
    		Image::make($image)->save( public_path('/img/women/' . $filename ) );

    		$woman->image = $filename;
        $woman->save();

        return redirect('women')->with('status', 'Tout baigne' );


    	}

    }


      public function update_avatar(Request $request){



        if($request->hasFile('image')){
      		$image = $request->file('image');
      		$filename = time() . '.' . $image->getClientOriginalExtension();
      		Image::make($image)->save( public_path('/img/women/' . $filename ) );
          $woman->fill($request->all());

      		$woman->image = $filename;
          $woman->save();


          return redirect('women')->with('status', 'Modifications enregistrées !' );
    }



  }


  public function profile(){
return view('women.show', ['woman' => $woman]);
  }

    /**
     * Display the specified resource.
     *
     * @param  \App\Woman  $woman
     * @return \Illuminate\Http\Response
     */
    public function show(Woman $woman)
    {
        //
        return view('women.show', ['woman' => $woman]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Woman  $woman
     * @return \Illuminate\Http\Response
     */
    public function edit(Woman $woman)
    {
        return view('women.edit', ['woman' => $woman]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Woman  $woman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Woman $woman)
    {
      $woman->update($request->all());

      if($request->hasFile('image')){
    		$image = $request->file('image');
    		$filename = time() . '.' . $image->getClientOriginalExtension();
    		Image::make($image)->save( public_path('/img/women/' . $filename ) );

    		$woman->image = $filename;
        $woman->save();

      return redirect('women');
    }

  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Woman  $woman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Woman $woman)
    {
      $woman->delete();
      return redirect('women');
    }
}
