<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Profile';
$this->params['breadcrumbs'][] = ['label' => 'Profile', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
  nav > .nav.nav-tabs{
    border: none;
    color:#fff;
    background:#272e38;
    border-radius:0;

  }
  nav > div a.nav-item.nav-link,
  nav > div a.nav-item.nav-link.active
  {
  border: none;
    padding: 18px 25px;
    color:#fff;
    background:#272e38;
    border-radius:0;
  }

  nav > div a.nav-item.nav-link.active:after
  {
  content: "";
  position: relative;
  bottom: -60px;
  left: -10%;
  border: 15px solid transparent;
  border-top-color: #e74c3c ;
  }
  .tab-content{
    background: #fdfdfd;
    line-height: 25px;
    border: 1px solid #ddd;
    border-top:5px solid #e74c3c;
    border-bottom:5px solid #e74c3c;
    padding:30px 25px;
  }

  nav > div a.nav-item.nav-link:hover,
  nav > div a.nav-item.nav-link:focus
  {
  border: none;
    background: #e74c3c;
    color:#fff;
    border-radius:0;
    transition:background 0.20s linear;
  }

  .canvas {
    border-style: solid;
    border-width: 1px;
    border-color: black;
  }

  input {
    font-family: verdana;
    font-size: 12pt;
  }
</style>
<div class="user-form">
  <?php $form = ActiveForm::begin(); ?>
    <nav>
      <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-data-tab" data-toggle="tab" href="#nav-data" role="tab" aria-controls="nav-data" aria-selected="true">Data User</a>
        <a class="nav-item nav-link" id="nav-password-tab" data-toggle="tab" href="#nav-password" role="tab" aria-controls="nav-password" aria-selected="false">Ganti Password</a>
        <a class="nav-item nav-link" id="nav-picture-tab" data-toggle="tab" href="#nav-picture" role="tab" aria-controls="nav-picture" aria-selected="false">Picture</a>
      </div>
    </nav>  
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-data" role="tabpanel" aria-labelledby="nav-data-tab">
        <div class="row">
          <div class="col-sm-6">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
          </div>
          <div class="col-sm-6">
            <?= $form->field($model, 'alamat')->textArea(['maxlength' => true]) ?>
            <?= $form->field($model, 'kota')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'propinsi')->textInput(['maxlength' => true]) ?>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
        <div class="col-sm-6">
          <?= $form->field($model, 'password_old')->passwordInput(['maxlength' => true]) ?>
          <?= $form->field($model, 'password_new')->passwordInput(['maxlength' => true]) ?>
          <?= $form->field($model, 'password_type')->passwordInput(['maxlength' => true]) ?>
        </div>
      </div>
      <div class="tab-pane fade" id="nav-picture" role="tabpanel" aria-labelledby="nav-picture-tab">
          <div class="row">
              <div class="col-sm-6">
                <img src="<?=$model->picture ?>" class="img-block" alt="User Image">
              </div>
              <div class="col-sm-6">
                <div id="gallery" width="320" height="240" class="canvas">
                  <canvas id="canv" width="275" height="183"></canvas>
                </div>
                <div class="row">
                  <?= $form->field($model, 'file')->fileInput()->label(false); ?>
                </div>
              </div>
          </div>
          <br>
          <!-- <div class="row">
            <div class"text-left"><button id="start-camera" class="pull-left">Start Camera</button></div>
          </div> -->
      </div>
      <br>
      <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
      </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<nav>
<script>
  $(document).ready(function(){
    $('#w0').submit(function() {
        if($("#user-password_new").val() != ''){
          if($("#user-password_old").val() == ''){
              alert('Password Lama belum diisi');
              $("#user-password_old").focus();
              return false;
          }
          if($("#user-password_type").val() == ''){
              alert('Ketik Ulang password harus diisi');
              $("#user-password_type").focus();
              return false;
          }

          if($("#user-password_new").val() !== $("#user-password_type").val()){
              alert('Password tidak sesuai dengan Ketik Ulang password');
              $("#user-password_type").focus();
              return false;
          }
        }
    });
  });

  $("#user-password_type").on("focusout", function() {
    if($(this).val() !== '' && $(this).val() !== $("#user-password_new").val()){
        alert('Password tidak sesuai dengan Ketik Ulang password');
        $("#user-password_type").focus();
        $(this).val('');
    }
  });

  $("#user-password_new").on("focusout", function() {
    if($("#user-password_old").val() == ''){
        alert('Password Lama belum diisi');
        $("#user-password_old").focus();
        $(this).val('');
    }
  });

  document.getElementById('user-file').onchange = function(e) {
    let img = new Image();
    img.onload = draw;
    img.onerror = failed;
    img.src = URL.createObjectURL(this.files[0]);
  };

  function draw() {
      let canvas = document.getElementById('canv'),
      ctx = canvas.getContext('2d');
      ctx.drawImage(this, 0, 0);
      document.getElementById('gallery').append(canvas);
  }

  function failed() {
    console.error("The provided file couldn't be loaded as an Image media");
  }
</script>