@extends('admin.layout.base')
@section('title','catalogue')
@section('data-page-id','adminRubric')
@section('sectionTitle','Catalogue')
@section('sectionDesc','Gestion de toutes les rubriques de votre boutique.')
@section('content')
    @include('includes.message')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header ">
                    <!-- Breadcrumbs-->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/admin">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Catalogue</li>
                    </ol>
                    <div class="card-header">
                        <h4 class="card-title"> Rubriques</h4>
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
                    @if(count($rubrics))
                        <table class="table table-striped table-bordered" id="catTable">
                            <thead>
                            <tr>
                            <tr>
                                <th class="text-center">Position</th>
                                <th class="text-center">Nom</th>
                                <th class="text-center">En ligne</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rubrics as $rubric)
                                <tr id="tr{{$rubric->id}}">
                                    <td class="text-center">{{$rubric->position}}</td>
                                    <td>
                                        <a href="/admin/rubriques/{{$rubric->id}}/"> {{$rubric->name}}</a>
                                    </td>
                                    <td>
                                        <div class="md-form d-flex justify-content-center">
                                            <input type="checkbox" class="switch activationRub activation{{$rubric->id}}" name="my-checkbox"  data-size="mini"  data-off-text="Non" data-on-text="Oui" @if($rubric->view ) value="1" checked @else value="0" @endif data-id="{{$rubric->id}}">
                                        </div>
                                    </td>
                                    <td class="td-actions text-right d-flex justify-content-end">
                                        <a href="/admin/rubriques/{{$rubric->id}}/">
                                            <button type="button" rel="tooltip" class="btn btn-info btn-sm btn-icon mr-2">
                                                <i class="fa fa-folder-open"></i>
                                            </button>
                                        </a>
                                        <a href="/admin/rubriques/{{$rubric->id}}/edit">
                                            <button type="button" rel="tooltip" class="btn btn-success btn-sm btn-icon mr-2">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </a>
                                        <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon delRubButton" data-id ="{{$rubric->id}}" data-name ="{{$rubric->name}}" >
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <input id="token{{$rubric->id}}" name="token" type="hidden" value="{{\App\Classes\CSRFToken::_token()}}">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="row mt-5">
                            <div class="col-10 offset-sm-1 alert alert-info">Pour créer un nouveau produit, veuillez sélectionner une rubrique existante ou en créer une nouvelle</div>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <span>
                                 <b> Désolé - </b> Pas de rubriques à afficher
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
                    <p class="modal-title" id="exampleModalLabel">Créer une nouvelle rubrique</p>
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
                        <input id="token" name="token" type="hidden" value="{{\App\Classes\CSRFToken::_token()}}">
                        <div class="form-group">
                            <label for="nameRubric">Nom de la rubrique</label>
                            <input type="texte" class="form-control " name="name" id="nameRubric" aria-describedby="Nom" placeholder="Entrer ici le nom de la rubrique que vous souhaitez créer">
                        </div>
                        <div class="text-left pt-2">
                            <Label class="mr-2 switch-lab">En Ligne : </Label>
                            <input type="checkbox" class="switch onLineCheck" id="onLine" name="view"  data-size="mini"  data-off-text="Non" data-on-text="Oui" value="0">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Annuler</button>
                    <button id="newRubricButton" type="button" class="btn btn-info"><i class="fas fa-check"></i>&nbsp;Créer cette rubrique</button>
                </div>
            </div>
        </div>
    </div>

@endsection
