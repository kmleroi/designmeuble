@extends('admin.layout.base')
@section('title','Product Category')
@section('data-page-id','exploreCategory')
@section('sectionTitle',$subCat->name)
@section('sectionDesc','Contenue de la catégorie.')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header ">
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/admin">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="/admin/rubriques">Catalogue</a>
                    </li>
                    <li class="breadcrumb-item "><a href="/admin/categories/{{$categorie->id}}/">{{$categorie->name}}</a></li>
                    <li class="breadcrumb-item active">{{$subCat->name}}&nbsp;<a href="/admin/subcategories/{{$subCat->id}}/edit">(modification)</a></li>
                </ol>
                <div class="card-header">
                    <h4 class="card-title">Produits</h4>
                </div>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-12 text-right">
                        <button class="btn btn-primary btn-fab btn-icon btn-round" data-toggle="modal" data-target="#addModal">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                @if(count($products))
                    <table class="table table-striped" id="subCatTable">
                        <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th>Nom</th>
                            <th>En ligne</th>
                            <!--<th class="text-right">Salary</th>-->
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr id="tr{{$product->id}}">
                                <td class="text-center">{{$product->id}}</td>
                                <td>
                                    <a href="/admin/products/{{$product->id}}/edit"> {{$product->name}}</a>
                                </td>
                                <td>
                                    <div class="md-form d-flex justify-content-center">
                                        <input type="checkbox" class="switch activationProduct activation{{$product->id}}" name="my-checkbox"  data-size="mini"  data-off-text="Non" data-on-text="Oui" @if($product->view ) value="1" checked @else value="0" @endif data-id="{{$product->id}}">
                                    </div>
                                </td>
                                <td class="td-actions text-right d-flex justify-content-end">
                                    <a href="/admin/products/{{$product->id}}/edit">
                                        <button type="button" rel="tooltip" class="btn btn-success btn-sm btn-icon mr-2">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </a>
                                    <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon delProduct" data-id ="{{$product->id}}" data-name ="{{$product->name}}" >
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <input id="token{{$product->id}}" name="token" type="hidden" value="{{\App\Classes\CSRFToken::_token()}}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning mt-3">
                        <span>
                            <b> Désolé - </b> Pas de produits à afficher
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="exampleModalLabel">Créer un nouveau produit dans <strong>{{$subCat->name}}</strong></p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning alert-dismissible fade show none notification" role="alert">
                    <strong class="msgNotification"></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form>
                    <input id="tokenProduct" name="token" type="hidden" value="{{\App\Classes\CSRFToken::_token()}}">
                    <input id="idRubric" name="category_id" type="hidden" value="{{$rubric->id}}">
                    <input id="idCat" name="category_id" type="hidden" value="{{$categorie->id}}">
                    <input id="idSubCat" name="sub_category_id" type="hidden" value="{{$subCat->id}}">
                    <div class="form-group">
                        <label for="refProduct">reference du produit</label>
                        <input type="texte" class="form-control " name="reference" id="refProduct" aria-describedby="Nom" placeholder="Entrer ici le reference du produit que vous souhaitez créer">
                    </div>
                    <div class="form-group">
                        <label for="refProduct">Nom du produit</label>
                        <input type="texte" class="form-control " name="name" id="nameProduct" aria-describedby="Nom" placeholder="Entrer ici le nom du produit que vous souhaitez créer">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Annuler</button>
                <button id="newProductButton" type="button" class="btn btn-info"><i class="fas fa-check"></i>&nbsp;Créer </button>
            </div>
        </div>
    </div>
</div>
@endsection
