<?php
/* @var $content string */
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
?>
<style>
    .formbox-container {
        background-color: #fff;
        display: inline-block;
        margin-top: 10px;
        margin-bottom: 20px;
        padding-bottom: 20px;
        width: 100%;
    }
    .formbox-container .formbox-header {
        background-color: #3a779a61;
        height: 20px;
        padding: 0 20px;
        border-radius: 2px 2px 2px 2px;
    }
    .formbox-container .formbox-body {
        padding: 20px;
        position: absolute;
    }
    .container-content {
        padding-left: 20px;
        padding-right: 20px;
        padding-top : 50px;
        overflow: hidden;
        margin-top: 0px;
    }
</style>
<div class="content-wrapper container-content">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="m-0">
                        <?php
                        if (!is_null($this->title)) {
                            echo "<u>".\yii\helpers\Html::encode($this->title)."</u>";
                        } else {
                            echo \yii\helpers\Inflector::camelize($this->context->id);
                        }
                        ?>
                    </h5>
                </div>
                <div class="col-sm-6">
                    <?php
                    echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => [
                            'class' => 'breadcrumb float-sm-right underline '
                        ]
                    ]);
                    ?>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="formbox-container">
            <?= Alert::widget() ?>
                <!-- Main content -->
                <div class="content">
                    <?= $content ?><!-- /.container-fluid -->
                <!-- /.content -->
            </div>
        </div>
    </section>
</div>