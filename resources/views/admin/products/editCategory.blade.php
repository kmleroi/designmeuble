@extends('admin.layout.base')
@section('title','Product Category')
@section('data-page-id','exploreCategory')
@section('sectionTitle',$categories->name)
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
                    <li class="breadcrumb-item">
                        <a href="/admin/rubriques/{{$rubric->id}}/">{{$rubric->name}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{$categories->name}}&nbsp;<a href="/admin/categories/{{$categories->id}}/edit">(modification)</a></li>
                </ol>
                <div class="card-header">
                    <h4 class="card-title"> Sous-catégories</h4>
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
                @if(count($subCat))
                    <table class="table table-striped table-bordered" id="subCatTable">
                        <thead>
                        <tr>
                            <th class="text-center">Position</th>
                            <th class="text-center">Nom</th>
                            <th class="text-center">En ligne</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subCat as $sub)
                            <tr id="tr{{$sub->id}}">
                                <td class="text-center">{{$sub->position}}</td>
                                <td>
                                    <a href="/admin/subcategories/{{$sub->id}}"> {{$sub->name}}</a>
                                </td>
                                <td>
                                    <div class="md-form d-flex justify-content-center">
                                        <input type="checkbox" class="switch activationSubCat activation{{$sub->id}}" name="my-checkbox"  data-size="mini"  data-off-text="Non" data-on-text="Oui" @if($sub->view ) value="1" checked @else value="0" @endif data-id="{{$sub->id}}">
                                    </div>
                                </td>
                                <td class="td-actions text-right d-flex justify-content-end">
                                    <a href="/admin/subcategories/{{$sub->id}}">
                                        <button type="button" rel="tooltip" class="btn btn-info btn-sm btn-icon mr-2">
                                            <i class="fa fa-folder-open"></i>
                                        </button>
                                    </a>
                                    <a href="/admin/subcategories/{{$sub->id}}/edit">
                                        <button type="button" rel="tooltip" class="btn btn-success btn-sm btn-icon mr-2">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </a>
                                    <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon delSubCatButton" data-id ="{{$sub->id}}" data-name ="{{$sub->name}}" >
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <input id="token{{$sub->id}}" name="token" type="hidden" value="{{\App\Classes\CSRFToken::_token()}}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning mt-3">
                        <span>
                            <b> Désolé - </b> Pas de sous-catégorie à afficher
                        </span>
                    </div>
                @endif
                <!--produit-->
                <div class="card-header">
                    <h4 class="card-title">Produits</h4>
                </div>
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="/admin/categories/addproduct" title="Ajouter un produit">
                            <button class="btn btn-primary btn-fab btn-icon btn-round">
                                <i class="fas fa-plus"></i>
                            </button>
                        </a>
                    </div>
                </div>
                <div>
                    <div class="alert alert-warning mt-3">
                        <span>
                            <b> Désolé - </b> Pas de produits à afficher
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="exampleModalLabel">Créer une nouvelle sous-catégorie dans <strong>{{$categories->name}}</strong></p>
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
                    <input id="tokenSousCat" name="token" type="hidden" value="{{\App\Classes\CSRFToken::_token()}}">
                    <input id="idCat" name="category_id" type="hidden" value="{{$categories->id}}">
                    <input id="idRub" name="rubric_id" type="hidden" value="{{$rubric->id}}">
                    <div class="form-group">
                        <label for="nameSousCat">Nom de la sous-catégorie</label>
                        <input type="texte" class="form-control " name="name" id="nameSousCat" aria-describedby="Nom" placeholder="Entrer ici le nom de la sous-catégorie que vous souhaitez créer">
                    </div>
                    <div class="text-left pt-2">
                        <Label class="mr-2 switch-lab">En Ligne : </Label>
                        <input type="checkbox" class="switch onLineCheck" id="onLine" name="view"  data-size="mini"  data-off-text="Non" data-on-text="Oui" value="0">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Annuler</button>
                <button id="newSousCatButton" type="button" class="btn btn-info"><i class="fas fa-check"></i>&nbsp;Créer </button>
            </div>
        </div>
    </div>
</div>
@endsection
