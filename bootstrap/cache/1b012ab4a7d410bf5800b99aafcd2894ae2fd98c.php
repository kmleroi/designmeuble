<?php $__env->startSection('title','Product Category'); ?>
<?php $__env->startSection('data-page-id','exploreCategory'); ?>
<?php $__env->startSection('sectionTitle',$subCat->name); ?>
<?php $__env->startSection('sectionDesc','Contenue de la catégorie.'); ?>
<?php $__env->startSection('content'); ?>
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
                    <li class="breadcrumb-item "><a href="/admin/categories/<?php echo e($categorie->id); ?>/"><?php echo e($categorie->name); ?></a></li>
                    <li class="breadcrumb-item active"><?php echo e($subCat->name); ?>&nbsp;<a href="/admin/subcategories/<?php echo e($subCat->id); ?>/edit">(modification)</a></li>
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
                <?php if(count($products)): ?>
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
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="tr<?php echo e($product->id); ?>">
                                <td class="text-center"><?php echo e($product->id); ?></td>
                                <td>
                                    <a href="/admin/products/<?php echo e($product->id); ?>/edit"> <?php echo e($product->name); ?></a>
                                </td>
                                <td>
                                    <div class="md-form d-flex justify-content-center">
                                        <input type="checkbox" class="switch activationProduct activation<?php echo e($product->id); ?>" name="my-checkbox"  data-size="mini"  data-off-text="Non" data-on-text="Oui" <?php if($product->view ): ?> value="1" checked <?php else: ?> value="0" <?php endif; ?> data-id="<?php echo e($product->id); ?>">
                                    </div>
                                </td>
                                <td class="td-actions text-right d-flex justify-content-end">
                                    <a href="/admin/products/<?php echo e($product->id); ?>/edit">
                                        <button type="button" rel="tooltip" class="btn btn-success btn-sm btn-icon mr-2">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </a>
                                    <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon delProduct" data-id ="<?php echo e($product->id); ?>" data-name ="<?php echo e($product->name); ?>" >
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <input id="token<?php echo e($product->id); ?>" name="token" type="hidden" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="alert alert-warning mt-3">
                        <span>
                            <b> Désolé - </b> Pas de produits à afficher
                        </span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="exampleModalLabel">Créer un nouveau produit dans <strong><?php echo e($subCat->name); ?></strong></p>
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
                    <input id="tokenProduct" name="token" type="hidden" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                    <input id="idRubric" name="category_id" type="hidden" value="<?php echo e($rubric->id); ?>">
                    <input id="idCat" name="category_id" type="hidden" value="<?php echo e($categorie->id); ?>">
                    <input id="idSubCat" name="sub_category_id" type="hidden" value="<?php echo e($subCat->id); ?>">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>