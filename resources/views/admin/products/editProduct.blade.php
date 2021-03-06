@extends('admin.layout.base')
@section('title','Noveau produit')
@section('data-page-id','addproduct')
@section('sectionTitle','Nouveau Produit')
@section('sectionDesc','Créer ici votre nouveau produit dans la sous-catégorie '.$subCat->name)
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
                        <li class="breadcrumb-item">
                            <a href="/admin/categories/{{$category->id}}/">{{$category->name}}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/admin/subcategories/{{$subCat->id}}">{{$subCat->name}}</a>
                        </li>
                        <li class="breadcrumb-item active">Nouveau produit</li>
                    </ol>
                    <div class="alert alert-danger fade show none notification" role="alert">
                        <strong class="msgNotification"></strong>
                    </div>
                    <div class="card-header">
                        <h6 class="card-title">NOUVEAU PRODUIT</h6>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="md-form d-flex justify-content-start">
                                <div class="ml-3 mr-3">
                                    <Label class="mr-2 switch-lab f700">En Ligne : </Label>
                                    <input type="checkbox" class="switch" id="viewProd" name="view"  @if($product->view ) value="1" checked @else value="0" @endif data-size="mini"  data-off-text="Non" data-on-text="Oui" >
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex justify-content-end">
                                <button class="mr-2 btn btn-info updateProdButton">Enregistrer&nbsp; <i class="fas fa-check"></i></button>
                                <form action="/admin/subcategories/{{$subCat->id}}">
                                    <button class="btn btn-danger">Fermer&nbsp; <i class="fas fa-times"></i></button>
                                </form>
                            </div>
                        </div>
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
                                            <a class="nav-link"  href="#priceSect" data-toggle="tab">Prix & Stock</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#technics" data-toggle="tab">Caractéristiques</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#seo" data-toggle="tab">SEO</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#imgs" data-toggle="tab">Images</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div><div class="card-body ">
                            <div class="tab-content text-center">
                                <!-----Partie dédiée aux informations générale-------->
                                <div class="tab-pane active " id="descGen">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group text-left">
                                                <label for="refProduct" class="ml-2 mb-2 f700">Reference produit <b>*</b> </label>
                                                <input type="texte" class="form-control form-controlBordered" id="refProd" @if($product)value="{{$product->reference}}" @endif >
                                            </div>
                                            <div class="form-group text-left">
                                                <label for="nameProd" class="ml-2 mb-2 f700">Nom produit <b>*</b> </label>
                                                <input type="texte" class="form-control form-controlBordered" id="nameProd" @if($product)value="{{$product->name}}" @endif >
                                            </div>
                                            <div class="form-group text-left">
                                                <label for="nameCat" class="ml-2 mb-2 f700">Courte description</label>
                                                <textarea class="form-control textareaBordered" id="resumeProd" rows="10" >{{$product->resume}}</textarea>
                                                <span class="help-block">Une courte description, utilisée lorsqu'un résumé ou une introduction est requise</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="brand_id" class="ml-2 mb-2 f700">Fabriquant</label>
                                                <select class="form-control form-controlBordered" id="brand_id">
                                                    <option value="0" >Chosissez une marque</option>
                                                    @if(count($brands))
                                                        @foreach($brands as $brand)
                                                            @if($product->brand_id == $brand->id)
                                                                <option value="{{$brand->id}}" selected >{{$brand->name}}</option>
                                                                @else
                                                                <option value="{{$brand->id}}" >{{$brand->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <option value="0">Rien à afficher</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="collection_id" class="ml-2 mb-2 f700">Collection</label>
                                                @if(count($collections))
                                                    <select class="form-control form-controlBordered" id="collection_id">
                                                        <option value="0">Choisissez une collection</option>
                                                        @foreach($collections as $col)
                                                            @if($product->collection_id == $col->id)
                                                                <option value="{{$col->id}}" selected >{{$col->name}}</option>
                                                            @else
                                                                <option value="{{$col->id}}" >{{$col->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <select class="form-control form-controlBordered" id="collection_id" disabled>
                                                        <option value="0" selected>Choisissez une collection</option>
                                                    </select>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="rubric_id" class="ml-2 mb-2 f700">Rubrique</label>
                                                <select class="form-control form-controlBordered" id="rubric_id">
                                                    @foreach($rubrics as $rub)
                                                        @if($rubric->id == $rub->id)
                                                            <option value="{{$rub->id}}" selected>{{$rub->name}}</option>
                                                        @else
                                                            <option value="{{$rub->id}}">{{$rub->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="category_id" class="ml-2 mb-2 f700">Catégorie</label>
                                                <select class="form-control form-controlBordered" id="category_id">
                                                    @foreach($categories as $cat)
                                                        @if($category->id == $cat->id)
                                                            <option value="{{$cat->id}}" selected>{{$cat->name}}</option>
                                                        @else
                                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="sub_category_id" class="ml-2 mb-2 f700">Sous-catégorie</label>
                                                <select class="form-control form-controlBordered" id="sub_category_id">
                                                    @foreach($subcategories as $sub)
                                                        @if($sub->id == $subCat->id)
                                                            <option value="{{$sub->id}}" selected>{{$sub->name}}</option>
                                                        @else
                                                            <option value="{{$sub->id}}">{{$sub->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-----Partie dédiée aux prix-------->

                                <div class="tab-pane " id="priceSect">
                                    <div class="row">
                                        <div class="col-sm-4 form-group text-left">
                                            <label for="titleCat" class="ml-2 mb-2 f700">Règle de taxe pour ce produit</label>
                                            <input type="texte" class="form-control form-controlBordered inputTVA"  value="TVA belge à 21%" disabled>
                                            <input type="hidden" id="tva" value="21">
                                        </div>
                                        <div class="col-sm-4 form-group text-left">
                                            <Label class="mr-2 switch-lab f700">Nouveauté : </Label>
                                            <input type="checkbox" class="switch" id="newProd" name="new"  @if($product->new ) value="1" checked @else value="0" @endif data-size="mini"  data-off-text="Non" data-on-text="Oui">
                                        </div>
                                        <div class="col-sm-4 form-group text-left">
                                            <Label class="mr-2 switch-lab f700">En promo : </Label>
                                            <input type="checkbox" class="switch switch-promo" id="promoProd" name="promo"  @if($product->promo ) value="1" checked @else value="0" @endif data-size="mini"  data-off-text="Non" data-on-text="Oui">
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-sm-4  justify-content-between">
                                            <div class="pricebox border">
                                                <p class="titleSection mb-3">Définition des prix</p>
                                                <p class="text-left sousTitre">Prix HT</p>
                                                <div class="input-group">
                                                    <input id="prix_ht" type="text" class="form-control"  placeholder="Entrer un prix HTVA" @if($product)value="{{$product->prixHtva}}"@else value="0" @endif>
                                                    <span class="input-group-addon d-flex justify-content-center align-items-center">&euro;</span>
                                                </div>
                                                <p class="text-left sousTitre">Prix TTC</p>
                                                <div class="input-group">
                                                    <input id="prix_ttc" type="text" class="form-control"  placeholder="Prix TVAC" @if($product)value="{{$product->prixTvac}}" @else value="0" @endif>
                                                    <span class="input-group-addon d-flex justify-content-center align-items-center">&euro;</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4  justify-content-between">
                                            <div class="pricebox border">
                                                <p class="titleSection  mb-3">Stock</p>
                                                <p class="text-left sousTitre">Quantité disponible</p>
                                                <div class="input-group">
                                                    <input id="stock" type="number" class="form-control"  placeholder="Entrer un stock" @if($product)value="{{$product->quantity}}" @else value="0" @endif>
                                                    <span class="input-group-addon d-flex justify-content-center align-items-center"><i class="fas fa-barcode"></i></span>
                                                </div>
                                                <p class="text-left sousTitre">Disponible sur commande</p>
                                                <div class="form-group text-left pl-1">
                                                    <input type="checkbox" class="switch switch-Commande" id="SurCommande" name="commande"  data-size="mini"  data-off-text="Non" data-on-text="Oui" value="0">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-sm-4  justify-content-between">
                                            <div class="pricebox border">
                                                <p class="titleSection  mb-3">Promo</p>
                                                <p class="text-left sousTitre">Prix promo HT</p>
                                                <div class="input-group">
                                                    <input id="prix_ht_promo" type="text" class="form-control"  placeholder="Entrer un prix HTVA"  @if($product->promo)value="{{$product->prixPromoHtva}}" @else value="0" disabled @endif>
                                                    <span class="input-group-addon d-flex justify-content-center align-items-center">&euro;</span>
                                                </div>
                                                <p class="text-left sousTitre">Prix promo TTC</p>
                                                <div class="input-group">
                                                    <input id="prix_ttc_promo" type="text" class="form-control"  placeholder="Prix TVAC"  @if($product->promo)value="{{$product->prixPromoTvac}}" @else value="0" disabled @endif>
                                                    <span class="input-group-addon d-flex justify-content-center align-items-center">&euro;</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-----Partie dédiée aux infos techniques-------->

                                <div class="tab-pane " id="technics" >
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group text-left">
                                                <label for="Assemblage" class="ml-2 mb-2 f700">Assemblage</label>
                                                <select class="form-control form-controlBordered" id="assemblage">
                                                    <option value="0" selected>Chosissez un type d'assemblage</option>
                                                    @foreach ($montages as $montage)
                                                        @if($montage->id == $details->assemblage_id)
                                                            <option value="{{$montage->id}}" selected>{{$montage->name}}</option>
                                                        @else
                                                            <option value="{{$montage->id}}">{{$montage->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group text-left">
                                                <label for="style" class="ml-2 mb-2 f700">Style</label>
                                                <select class="form-control form-controlBordered" id="style">
                                                    <option value="0" selected>Chosissez un style</option>
                                                    @foreach ($styles as $style)
                                                        @if($style->id == $details->style_id)
                                                            <option selected value="{{$style->id}}">{{$style->name}}</option>
                                                        @else
                                                            <option value="{{$style->id}}">{{$style->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group text-left">
                                                @if($details->finition)
                                                    @php
                                                        $finition = json_decode($details->finition);
                                                    @endphp
                                                @else
                                                    @php
                                                        $finition = [];
                                                    @endphp
                                                @endif
                                                <label for="finition" class="ml-2 mb-2 f700">Finition</label><br>
                                                @foreach ($materials as $material)
                                                    <span class="d-flex align-content-center">
                                                        @if(in_array($material->name, $finition))
                                                            <input type="checkbox" checked class="mr-2 material materialChecked" value="{{$material->name}}"><span class="mr-2">{{$material->name}}</span>
                                                        @else
                                                            <input type="checkbox"  class="mr-2 material" value="{{$material->name}}"><span class="mr-2">{{$material->name}}</span>
                                                        @endif
                                                     </span>
                                                @endforeach
                                            </div>
                                            <div class="form-group text-left">
                                                <label for="descProd" class="ml-2 mb-2 f700">Description</label>
                                                <textarea class="form-control textareaBordered" id="descProd" rows="20" >@if($details){{$details->description}}@endif</textarea>
                                                <span class="help-block">Description du produit.</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="longeur" class="ml-2 mb-2 f700">Longeur</label>
                                                <input type="number" class="form-control form-controlBordered" id="longeur" @if($details->longeur)value="{{$details->longeur}}"@else value="0" @endif>
                                            </div>
                                            <div class="form-group">
                                                <label for="largeur" class="ml-2 mb-2 f700">Largeur</label>
                                                <input type="number" class="form-control form-controlBordered" id="largeur"  @if($details->largeur)value="{{$details->largeur}}"@else value="0" @endif >
                                            </div>
                                            <div class="form-group">
                                                <label for="hauteur" class="ml-2 mb-2 f700">Hauteur</label>
                                                <input type="number" class="form-control form-controlBordered" id="hauteur"  @if($details->hauteur)value="{{$details->hauteur}}"@else value="0" @endif>
                                            </div>
                                            <div class="form-group">
                                                <label for="poids" class="ml-2 mb-2 f700">Poids</label>
                                                <input type="number" class="form-control form-controlBordered" id="poids"  @if($details->poids)value="{{$details->poids}}"@else value="0" @endif>
                                                <span class="help-block text-left">Arrondissez ces valeurs à l'unité.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-----Partie dédiée aux infos SEO-------->

                                <div class="tab-pane" id="seo">
                                    <div class="form-group text-left">
                                        <label for="titleProd" class="ml-2 mb-2 f700">Titre de la page</label>
                                        <input type="texte" class="form-control form-controlBordered" id="titleProd"
                                               @if($details)value="{{$details->title}}"@endif
                                               placeholder="Assurez-vous d'avoir un titre clair et qui contient les mots-clés correspondant à la page en cours">
                                        <span class="help-block">L'élément HTML TITLE est le plus important dans votre page</span>
                                    </div>
                                    <div class="form-group text-left">
                                        <label for="metaDescProd" class="ml-2 mb-2 f700">Meta description</label>
                                        <textarea class="form-control textareaBordered" id="metaDescProd" rows="10"  placeholder="Assurez-vous d'avoir des mots-clés présents dans la page courante">@if($details){{$details->metaDescription}}@endif</textarea>
                                        <span class="help-block">Votre description ne devrait pas dépasser 150 à 160 caractères</span>
                                    </div>
                                    <div class="form-group text-left">
                                        <label for="metaKeyProd" class="ml-2 mb-2 f700">Meta keywords</label>
                                        <textarea class="form-control textareaBordered" id="metaKeyProd" rows="10"  placeholder="Ne répétez pas sans cesse les mêmes mots-clés dans une lignes. Préférez utiliser des expressions de mots-clés. ">@if($details){{$details->metaKeywords}}@endif</textarea>
                                        <span class="help-block">Vous n'avez pas besoin d'utiliser de virgules ou d'autres signes de ponctuation</span>
                                    </div>
                                </div>
                                <!-----Partie dédiée à l'image-------->
                                <div class="tab-pane text-center " id="imgs">
                                    <!--
                                    <div class="row">
                                        <div id="dropZone" class="col-10 offset-1" >
                                            <h4>Choisissez vos image...</h4>
                                            <input id="file" type="file" class="none" multiple>
                                            <button type="button" class="btn btn-primary addFileBt">Ajouter des fichiers</button>
                                            <div class="row" id="prev"></div>
                                        </div>
                                    </div>
                                    -->
                                    <div id="dropZone">
                                        <h4>Drag & Drop Files...</h4>
                                        <input type="hidden" id="idProduct" value="{{$product->id}}">
                                        <button class="addFileBt btn btn-success">Add Files &nbsp; <i class="fas fa-plus"></i></button><input class="none" type="file" id="fileupload" name="attachments[]" multiple>
                                    </div>
                                    <h1 id="error"></h1><br><br>
                                    <h1 id="progress"></h1><br><br>
                                    <div class="row ">
                                        <div class="col-sm-8 offset-sm-2">
                                            @if(count($product_images))
                                                <table class="table table-striped table-bordered imageLoad">
                                                    <tbody>
                                                    @foreach($product_images as $img)
                                                        <tr id="tr{{$img->id}}">
                                                            <td class="text-center">{{$img->position}}</td>
                                                            <td>
                                                                <img class="img-thumbnail" src="/images/uploads/{{$img->name}}" alt="">
                                                                <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon delSubCatButton" data-id ="{{$img->id}}" data-name ="{{$img->name}}" >
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <div class="alert alert-warning mt-3">
                                                    <span>
                                                        <b> Désolé - </b> Pas d'images à afficher
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row" id="files">

                                    </div>
                                <input id="token" name="token" type="hidden" value="{{\App\Classes\CSRFToken::_token()}}">
                                <input id="detailId" name="detail" type="hidden" value="{{$product->product_detail_id}}">
                                <input id="idProdImage" name="idProd" type="hidden" value="{{$product->id}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
