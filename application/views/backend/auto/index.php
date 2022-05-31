<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="/<?= ADM_CONTROLLER ?>/menu/">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span><?= $title ?></span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- END PAGE HEADER-->

<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"><?= $title ?></h1>
<!-- END PAGE TITLE-->

<?php // Отображаем сообщения пользователю ?>
<?php if (isset($_SESSION['success'])) : ?>
    <div class="alert alert-block alert-success fade in">
        <button type="button" class="close" data-dismiss="alert"></button>
		<?= $_SESSION['success']; ?>
    </div>
	<?php unset($_SESSION['success']); ?>
<?php endif; ?>
<?php if (isset($_SESSION['error'])) : ?>
    <div class="alert alert-block alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert"></button>
		<?php foreach ($_SESSION['error'] as $error) : ?>
			<?= $error ?>
            <br/>
		<?php endforeach; ?>
    </div>
	<?php unset($_SESSION['error']); ?>
<?php endif; ?>

<div class="row">
    <div class="portlet bordered">
        <div class="accordion" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #fff;">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1"><i
                                    class="fa fa-plus"></i> <?= $add ?></a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <form action="<?= $a_path ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="on_stock" value="999" class="form-control" >
                        <div class="panel-body">
                            <ul class="nav nav-pills">
                                <li class="active">
                                    <a href="#tab_1_1" data-toggle="tab">Информация</a>
                                </li>
                                <li>
                                    <a href="#tab_1_2" data-toggle="tab">Служебная информация</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="tab_1_1">
                                    <div class="table-scrollable">
                                        <table class="table table-bordered table-striped table-hover">
                                            <tbody>
                                            <tr>
                                                <td>Модель</td>
                                                <td>
                                                    <select name="model_id" id="" class="form-control">
                                                        <option value="0"> - Выбрать Модель - </option>
                                                        <?php foreach ($models as $model) {?>
                                                            <option value="<?=$model->id?>"> <?=$model->title?> </option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                                <tr>
                                                    <td>Заголовок *</td>
                                                    <td><input type="text" name="titleRU" class="form-control" required></td>
                                                </tr>
<!--                                            --><?// foreach ($langs as $lang) { ?>
<!--                                                <tr>-->
<!--                                                    <td width="200">Описание --><?//= $lang ?><!--</td>-->
<!--                                                    <td>-->
<!--                                                        <textarea name="desc--><?//= $lang ?><!--" id="desc--><?//= $lang ?><!--"-->
<!--                                                                  cols="15" rows="5"-->
<!--                                                                  class="form-control"></textarea>-->
<!--                                                    </td>-->
<!--                                                </tr>-->
<!--                                            --><?// } ?>
                                            <? foreach ($langs as $lang) { ?>
                                                <tr>
                                                    <td width="200">Текст <?= $lang ?></td>
                                                    <td>
                                                        <textarea name="text<?= $lang ?>" id="text<?= $lang ?>"
                                                                  cols="30" rows="10"
                                                                  class="form-control ckeditor"></textarea>
                                                    </td>
                                                </tr>
                                            <? } ?>
                                            <tr>
                                                <td>Цена</td>
                                                <td><input type="text" name="price" class="form-control" required></td>
                                            </tr>
                                            <tr>
                                                <td>Цена со скидкой</td>
                                                <td><input type="text" name="discount_price" class="form-control" ></td>
                                            </tr>
                                            <tr>
                                                <td>Батерея</td>
                                                <td><input type="text" name="battery" class="form-control" ></td>
                                            </tr>
                                            <tr>
                                                <td>Запас хода</td>
                                                <td><input type="text" name="travel" class="form-control" ></td>
                                            </tr>
                                            <tr>
                                                <td>Разгон</td>
                                                <td><input type="text" name="acceleration" class="form-control" ></td>
                                            </tr>
                                            <tr>
                                                <td width="200">Изображение</td>
                                                <td>
                                                    <input type="file" name="images[]" id="file" multiple
                                                           class="form-control">
                                                    <div class="note note-warning"
                                                         style="margin-bottom: 0px; margin-top: 10px;">
                                                        <p>
                                                            Допустимое разрешение: 1200x800 2мб
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="200">&nbsp;</td>
                                                <td>
                                                    <button type="submit" class="btn green"><i class="fa fa-check"></i>
                                                        Добавить
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab_1_2">
                                    <div class="table-scrollable">
                                        <table class="table table-bordered table-striped table-hover">
                                            <tbody>
                                            <? foreach ($langs as $lang) { ?>
                                                <tr>
                                                    <td width="200">Заголовок <?= $lang ?></td>
                                                    <td>
                                                        <input type="text" name="seoTitle<?= $lang ?>"
                                                               class="form-control">
                                                    </td>
                                                </tr>
                                            <? } ?>
                                            <? foreach ($langs as $lang) { ?>
                                                <tr>
                                                    <td width="200">Ключевые слова <?= $lang ?></td>
                                                    <td>
                                                        <textarea name="seoKeywords<?= $lang ?>"
                                                                  id="keywords<?= $lang ?>" cols="15" rows="5"
                                                                  class="form-control"></textarea>
                                                    </td>
                                                </tr>
                                            <? } ?>
                                            <? foreach ($langs as $lang) { ?>
                                                <tr>
                                                    <td width="200">Описание <?= $lang ?></td>
                                                    <td>
                                                        <textarea name="seoDesc<?= $lang ?>"
                                                                  id="description<?= $lang ?>" cols="30"
                                                                  rows="10" class="form-control"></textarea>
                                                    </td>
                                                </tr>
                                            <? } ?>
                                            <tr>
                                                <td width="200">&nbsp;</td>
                                                <td>
                                                    <button type="submit" class="btn green"><i class="fa fa-check"></i>
                                                        Добавить
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($objects)) : ?>
    <div class="row">
        <div class="portlet light">
            <div class="portlet-body">
                <form action="<?= $o_path; ?>" method="post">
                    <div class="table-scrollable">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th width="100"> Сортировка</th>
                                <th> Название</th>
                                <th width="180"></th>
                                <th width="180"></th>
                                <th width="305"> Действия</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php foreach ($objects as $item): ?>
                                <tr style="height: 51px;">
                                    <td class="align-middle">
                                        <input type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')" min="1"
                                               class="form-control text-center sorder" value="<?= $item->sorder ?>"
                                               name="so[<?= $item->id ?>]">
                                    </td>
                                    <td class="align-middle"><a style="font-weight: 900;"
                                                                href="<?= $e_path . $item->id; ?>"><?= $item->titleRU ?></a>
                                    </td>
                                    <td class="align-middle">
                                        <?php $cmod = (!empty($item->home_shown)) ? 'checked' : '' ?>
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <input data-col="home_shown" data-table="<?= $table ?>"
                                                   type="checkbox" <?= $cmod ?> value="<?= $item->id ?>"
                                                   class="mine_change_check">Показать на Главной
                                            <span></span>
                                        </label>
                                    </td>
                                    <td class="align-middle">
										<?php $cmod = (!empty($item->isShown)) ? 'checked' : '' ?>
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <input data-col="isShown" data-table="<?= $table ?>"
                                                   type="checkbox" <?= $cmod ?> value="<?= $item->id ?>"
                                                   class="mine_change_check">Показать на сайте
                                            <span></span>
                                        </label>
                                    </td>
                                    <td class="align-middle">
                                        <a href="<?= $e_path . $item->id . '/' ?>"
                                           class="btn btn-xs default btn-editable green-stripe">
                                            <i class="glyphicon glyphicon-edit"></i> Редактировать
                                        </a>
                                        <a href="<?= $del_path . $item->id . '/' ?>"
                                           class="btn btn-xs default btn-editable red-stripe mine_delete_row">
                                            <i class="glyphicon glyphicon-remove-circle"></i> Удалить
                                        </a>
                                    </td>
                                </tr>
							<?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn green"><i class="fa fa-check"></i> Обновить порядок</button>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<link rel="stylesheet" href="/assets/plugins/jquery-minicolors/jquery.minicolors.css">
<script src="/assets/plugins/jquery-minicolors/jquery.minicolors.min.js"></script>

<script>
    $(function () {
        $('.minicolors-input').minicolors({});
    })
</script>
