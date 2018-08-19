<!-----test si on veut modifier une catégorie ou une sous categorie -------->
@php

    if(isset($rubric)){
        if(isset($category)){
            if(isset($subCat)){
                $role = 3;
                $data = $subCat;
            }else{
                $role = 2;
                $data = $category;
            }
        }else{
            $role = 1;
            $data = $rubric;
        }
    }

@endphp
@extends('admin.layout.base')
@section('title','Edition Categorie')
@section('data-page-id','editCategory')
@section('sectionTitle',$data->name)
@section('sectionDesc','Mise à jour de la catégorie.')
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
                    @if($role >= 2)
                        <li class="breadcrumb-item">
                            <a href="/admin/categories/{{$category->id}}/">{{$category->name}}</a>
                        </li>
                    @endif
                    @if($role == 3)
                        <li class="breadcrumb-item">
                            <a href="/admin/subcategories/{{$subCat->id}}">{{$subCat->name}}</a>
                        </li>
                    @endif
                    <li class="breadcrumb-item active">Edition</li>
                </ol>
                <div class="alert alert-danger fade show none notification" role="alert">
                    <strong class="msgNotification"></strong>
                </div>
                <div class="card-header">
                    <h6 class="card-title"> MISE À JOUR DE {{$data->name}}</h6>
                </div>
            </div>
            <div class="card-body ">
                <div class="d-flex justify-content-end">
                    @if($role == 1)
                        <button class="mr-2 btn btn-info updateRubButton">Enregistrer&nbsp; <i class="fas fa-check"></i></button>
                        <form action="/admin/rubriques">
                            <button class="btn btn-danger">Fermer&nbsp; <i class="fas fa-times"></i></button>
                        </form>
                    @elseif($role == 2)
                        <button class="mr-2 btn btn-info updateCatButton">Enregistrer&nbsp; <i class="fas fa-check"></i></button>
                        <form action="/admin/rubriques/{{$rubric->id}}/">
                            <button class="btn btn-danger">Fermer&nbsp; <i class="fas fa-times"></i></button>
                        </form>
                    @else
                    <button class="mr-2 btn btn-info updateSubCatButton">Enregistrer&nbsp; <i class="fas fa-check"></i></button>
                    <form action="/admin/categories/{{$category->id}}/">
                        <button class="btn btn-danger">Fermer&nbsp; <i class="fas fa-times"></i></button>
                    </form>
                    @endif

                </div>
                <div class="card card-nav-tabs card-plain">
                    <div class="card-header card-header-danger">
                        <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#descGen" data-toggle="tab">Description générale</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#seo" data-toggle="tab">SEO</a>
                                    </li>
                                    @if($role != 1)
                                    <li class="nav-item">
                                        <a class="nav-link" href="#imgs" data-toggle="tab">Images</a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div><div class="card-body ">
                        <div class="tab-content text-center">
                            <!-----Partie dédiée aux informations générale-------->
                            <div class="tab-pane active" id="descGen">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group text-left">
                                            <label for="nameCat" class="ml-2 mb-2 f700">Nom de la Catégorie<b>*</b> </label>
                                            <input type="texte" class="form-control form-controlBordered" id="nameCat" value="{{$data->name}}">
                                        </div>
                                        @if($role != 1)
                                        <div class="form-group text-left">
                                            <label for="nameCat" class="ml-2 mb-2 f700">Description</label>
                                            <textarea class="form-control textareaBordered" id="descCat" rows="10" >{{$data->description}}</textarea>
                                            <span class="help-block">Une courte description, utilisée lorsqu'un résumé ou une introduction est requise</span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        @if($role != 1)
                                            <div class="form-group">
                                                <label for="rubric_id" class="ml-2 mb-2 f700">Rubrique</label>
                                                <select class="form-control form-controlBordered" id="rubric_id">
                                                    @foreach($rubrics as $rub)
                                                        @if($category->rubric_id == $rub->id)
                                                            <option value="{{$rub->id}}" selected>{{$rub->name}}</option>
                                                        @else
                                                            <option value="{{$rub->id}}">{{$rub->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                             @if($role==3)
                                             <div class="form-group">
                                                 <label for="category_id" class="ml-2 mb-2 f700">Catégorie Parente</label>
                                                 <select class="form-control form-controlBordered" id="category_id">
                                                 @foreach($categories as $cat)
                                                    @if($subCat->category_id == $cat->id)
                                                        <option value="{{$cat->id}}" selected>{{$cat->name}}</option>
                                                    @else
                                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                    @endif
                                                @endforeach
                                                 </select>
                                            </div>
                                            @endif
                                        @endif
                                        <div class="text-left pt-2">
                                            <Label class="mr-2 switch-lab f700 ">En Ligne : </Label>
                                            <input type="checkbox" class="switch onLineCheck" name="view"  data-size="mini"  data-off-text="Non" data-on-text="Oui" @if($data->view == 1) value="1" checked @else value="0" @endif>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-----Partie dédiée aux infos SEO-------->

                            <div class="tab-pane" id="seo">
                                <div class="form-group text-left">
                                    <label for="titleCat" class="ml-2 mb-2 f700">Titre de la page</label>
                                    <input type="texte" class="form-control form-controlBordered" id="titleCat" value="{{$data->title}}" placeholder="Assurez-vous d'avoir un titre clair et qui contient les mots-clés correspondant à la page en cours">
                                    <span class="help-block">L'élément HTML TITLE est le plus important dans votre page</span>
                                </div>
                                <div class="form-group text-left">
                                    <label for="metaDescCat" class="ml-2 mb-2 f700">Meta description</label>
                                    <textarea class="form-control textareaBordered" id="metaDescCat" rows="10"  placeholder="Assurez-vous d'avoir des mots-clés présents dans la page courante">{{$data->metaDescription}}</textarea>
                                    <span class="help-block">Votre description ne devrait pas dépasser 150 à 160 caractères</span>
                                </div>
                                <div class="form-group text-left">
                                    <label for="metaKeyCat" class="ml-2 mb-2 f700">Meta keywords</label>
                                    <textarea class="form-control textareaBordered" id="metaKeyCat" rows="10"  placeholder="Ne répétez pas sans cesse les mêmes mots-clés dans une lignes. Préférez utiliser des expressions de mots-clés. ">{{$data->metaKeywords}}</textarea>
                                    <span class="help-block">Vous n'avez pas besoin d'utiliser de virgules ou d'autres signes de ponctuation</span>
                                </div>
                            </div>
                            @if($role != 1)
                            <!-----Partie dédiée à l'image-------->
                            <div class="tab-pane text-center" id="imgs">
                                <div class="apercu">
                                    <img src="/images/noimage.png" alt="">
                                </div>
                                <input type="text" value="noimage.png" id="imageCat" >
                            </div>
                            @endif
                            <input id="token" name="token" type="hidden" value="{{\App\Classes\CSRFToken::_token()}}">
                            <input id="idCat" name="idCat" type="hidden" value="{{$data->id}}">
                        </div>
                    </div>
                </div>
            </div>
            <small class="m-3">Rubrique créée le {{$data->created_at}}. Dernière modification le {{$data->updated_at}}</small>
        </div>
    </div>
</div>

@endsection
