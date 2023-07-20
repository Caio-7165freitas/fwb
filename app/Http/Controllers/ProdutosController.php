<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Symfony\Contracts\Service\Attribute\Required;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $produtos = Produtos::latest()->paginate(5);


        return view('produtos.index',compact('produtos'))

            ->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('produtos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([

            'descricao' => 'required',

            'qtd' => 'required',

            'precoUnitario' => 'required',

            'precoVenda' => 'required',

        ]);


        Produtos::create($request->all());


        return redirect()->route('produtos.index')

                        ->with('success','Produto criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produtos $produtos): View
    {
        return view('produtos.show',compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produtos $produtos): View
    {
        return view('produtos.edit',compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produtos $produtos): RedirectResponse
    {
        $request->validate([

            'descricao' => 'required',

            'qtd' => 'required',

            'precoUnitario' => 'required',

            'precoVenda' => 'required',

        ]);


        $produtos->update($request->all());


        return redirect()->route('produtos.index')

                        ->with('success','Produto atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produtos $produtos): RedirectResponse
    {
        $produtos->delete();


        return redirect()->route('produtos.index')

                        ->with('success','Produto excluído com sucesso.');
    }
}
