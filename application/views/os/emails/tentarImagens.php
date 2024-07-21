<?

<div class="span12 pull-left" id="divAnexos" style="margin-left: 0">
    <div class="span10">
        <label for="userfile">Anexo</label>
        <input type="file" class="span12" name="userfile[]" id="userfile" multiple="multiple" size="20" onchange="previewImage(event)" />
    </div>
    <div class="span3" style="min-height: 150px; margin-left: 0">
        <img id="preview" src="#" alt="Pré-visualização da Imagem" style="display: none; max-height: 150px;" />
    </div>
</div>

<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('preview');
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>







<div id="formAnexos" action="javascript:;" accept-charset="utf-8" method="post">
    <div class="span10">
        <input type="hidden" name="idProdutoImg" id="idProdutoImg" value="" />
        <label for="userfile">Anexo</label>
        <input type="file" class="span12" name="userfile[]" id="userfile" multiple="multiple" size="20" onchange="previewImage(event)" />
    </div>
    <div class="span3" style="min-height: 150px; margin-left: 0">
        <img id="preview" src="#" alt="Pré-visualização da Imagem" style="display: none; max-height: 150px;" />
    </div>
</div>

<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('preview');
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>




<div id="formAnexos"  action="javascript:;"
    accept-charset="utf-8" s method="post">
    <div class="span10">
        <input type="hidden" name="idProdutoImg" id="idProdutoImg"
            value="" />
        <label for="">Anexo</label>
        <input type="file" class="span12" name="userfile[]" multiple="multiple"
            size="20" />
    </div>

    </div>




    <div class="control-group">
    <div>
    <div class="span12">
        <div class="span12" style="min-height: 200px; margin-left: 0">
            <img id="preview" src="#" alt="Pré-visualização da Imagem" style="display: none; max-height: 200px;" />
        </div>
    </div>
 <!-- #region -->
  <div class="span9" >
    <div class="span11" >

    <div id="formAnexos" action="javascript:;" accept-charset="utf-8" method="post">
        <div class="span10">
            <input type="hidden" name="idProdutoImg" id="idProdutoImg" value="" />
            <label for="userfile">Anexo</label>
            <input type="file" class="span12" name="userfile[]" id="userfile" multiple="multiple" size="20" onchange="previewImage(event)" />
        </div>
        
    </div>

    </div>
</div>

</div>

 /// bom

<div class="control-group span12">
    <div class="span12 div-teste " >
        <div>
            <div class="span12" style="">
                <img id="preview" src="#" alt="Pré-visualização da Imagem" style="" />
            </div>
        </div>
        
    </div>
    <div>
        <div id="formAnexos" action="javascript:;" accept-charset="utf-8" method="post">
            <div class="span10">
                <input type="hidden" name="idProdutoImg" id="idProdutoImg" value="" />
                <label for="userfile"></label>
                <input type="file" class="span12" name="userfile[]" id="userfile" multiple="multiple" size="20" onchange="previewImage(event)" />
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('preview');
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>






///////////////////

<div class="control-group span12">
    <div class="span12 div-teste">
        <div class="span12" style="position: relative; text-align: center;">
            <button id="prevBtn" onclick="prevImage()" style="position: absolute; left: 0; top: 50%; transform: translateY(-50%);">Anterior</button>
            <img id="preview" src="assets/img/produtoIcon.jpg" alt="Pré-visualização da Imagem" style="max-height: 300px; width: auto;" />
            <button id="nextBtn" onclick="nextImage()" style="position: absolute; right: 0; top: 50%; transform: translateY(-50%);">Próxima</button>
        </div>
    </div>
    <div>
        <div id="formAnexos" action="javascript:;" accept-charset="utf-8" method="post">
            <div class="span10">
                <input type="hidden" name="idProdutoImg" id="idProdutoImg" value="" />
                <label for="userfile">Anexo</label>
                <input type="file" class="span12" name="userfile[]" id="userfile" multiple="multiple" size="20" onchange="previewImages(event)" />
            </div>
        </div>
    </div>
</div>


let currentImageIndex = 0;
let images = [];

function previewImages(event) {
    images = [];
    const files = event.target.files;
    for (let i = 0; i < files.length; i++) {
        const reader = new FileReader();
        reader.onload = function(e) {
            images.push(e.target.result);
            if (i === 0) {
                document.getElementById('preview').src = e.target.result;
            }
        };
        reader.readAsDataURL(files[i]);
    }
}

function prevImage() {
    if (images.length > 0) {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        document.getElementById('preview').src = images[currentImageIndex];
    }
}

function nextImage() {
    if (images.length > 0) {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        document.getElementById('preview').src = images[currentImageIndex];
    }
}



////////////////////

<div class="control-group span12">
    <div class="span12 div-teste">
        <div class="span12" style="position: relative; text-align: center;">
            <button id="prevBtn" onclick="prevImage()" style="position: absolute; left: 0; top: 50%; transform: translateY(-50%);">Anterior</button>
            <img id="preview" src="<?php echo base_url('assets/img/produtoIcon.jpg'); ?>" alt="Pré-visualização da Imagem" style="max-height: 300px; width: auto;" />
            <button id="nextBtn" onclick="nextImage()" style="position: absolute; right: 0; top: 50%; transform: translateY(-50%);">Próxima</button>
        </div>
    </div>
    <div>
        <div id="formAnexos" action="javascript:;" accept-charset="utf-8" method="post">
            <div class="span10">
                <input type="hidden" name="idProdutoImg" id="idProdutoImg" value="" />
                <label for="userfile">Anexo</label>
                <input type="file" class="span12" name="userfile[]" id="userfile" multiple="multiple" size="20" onchange="previewImages(event)" />
            </div>
        </div>
    </div>
</div>

<script>
let currentImageIndex = 0;
let images = [];

function previewImages(event) {
    images = [];
    const files = event.target.files;
    for (let i = 0; i < files.length; i++) {
        const reader = new FileReader();
        reader.onload = function(e) {
            images.push(e.target.result);
            if (i === 0) {
                document.getElementById('preview').src = e.target.result;
            }
        };
        reader.readAsDataURL(files[i]);
    }
}

function prevImage() {
    if (images.length > 0) {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        document.getElementById('preview').src = images[currentImageIndex];
    }
}

function nextImage() {
    if (images.length > 0) {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        document.getElementById('preview').src = images[currentImageIndex];
    }
}
</script>







//////////////

<div class="control-group span12">
    <div class="span12 ">
        <div class="span12" style="position: relative; text-align: center;">
            <button id="prevBtn" onclick="prevImage()" style="position: absolute; left: 0; top: 50%; transform: translateY(-50%);">Anterior</button>
            <img id="preview" src="<?php echo base_url('assets/img/produtoIcon.jpg'); ?>" alt="Pré-visualização da Imagem" style="max-height: 300px; width: auto; margin-top: 20px;" />
            <button id="nextBtn" onclick="nextImage()" style="position: absolute; right: 0; top: 50%; transform: translateY(-50%);">Próxima</button>
        </div>
    </div>
    <div>
        <div id="formAnexos" action="javascript:;" accept-charset="utf-8" method="post">
            <div class="span10">
                <input type="hidden" name="idProdutoImg" id="idProdutoImg" value="" />
                <label for="userfile">Anexo</label>
                <input type="file" class="span12" name="userfile[]" id="userfile" multiple="multiple" size="20" onchange="previewImages(event)" />
            </div>
        </div>
    </div>
</div>

<script>
let currentImageIndex = 0;
let images = [];

function previewImages(event) {
    images = [];
    const files = event.target.files;
    for (let i = 0; i < files.length; i++) {
        const reader = new FileReader();
        reader.onload = function(e) {
            images.push(e.target.result);
            if (i === 0) {
                document.getElementById('preview').src = e.target.result;
            }
        };
        reader.readAsDataURL(files[i]);
    }
}

function prevImage() {
    if (images.length > 0) {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        document.getElementById('preview').src = images[currentImageIndex];
    }
}

function nextImage() {
    if (images.length > 0) {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        document.getElementById('preview').src = images[currentImageIndex];
    }
}
</script>

