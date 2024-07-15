

<div class="control-group span3" >
                                <div class="controls span12" style="padding: 1%; margin-left: 0" id="compativel-container">
                                <label for="compativel" >Compatíveis</label>
                                    <div class="compativel-input" class="controls" id="compativel-container">
                                        <input id="compativel-0" type="text" name="compativel[]" onChange="javascript:this.value=this.value.toUpperCase();" />
                                        <button type="button" onclick="addCompativelInput()" class="btn-add">+</button>
                                    </div>
                                </div>

                            </div>







                            <div class="controls span12" style="padding: 1%; margin-left: 0" >
                                <div class="span12" id="compativel-container" >
                                <label for="compativel" >Compatíveis</label>
                                    <div class="compativel-input" class="controls" id="compativel-container">
                                        <input id="compativel-0" type="text" name="compativel[]" onChange="javascript:this.value=this.value.toUpperCase();" />
                                        <button type="button" onclick="addCompativelInput()" class="btn-add">+</button>
                                    </div>
                                </div>
                            </div>









                            <!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Dinâmico</title>
    <style>
        .control-group {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <form id="dynamicForm">
        <div class="control-group">
            <label for="modeloProduto1" class="control-label">Modelo<span class="required">*</span></label>
            <div class="controls">
                <input id="modeloProduto1" type="text" name="modeloProduto1" onChange="this.value=this.value.toUpperCase();" />
                <button type="button" onclick="addField()">Adicionar</button>
            </div>
        </div>
    </form>

    <script>
        let fieldCount = 1;

        function addField() {
            const lastField = document.querySelector(`#modeloProduto${fieldCount}`);
            if (lastField.value.trim() === '') {
                alert('Por favor, preencha o campo antes de adicionar outro.');
                return;
            }

            fieldCount++;
            const newFieldGroup = document.createElement('div');
            newFieldGroup.className = 'control-group';
            newFieldGroup.innerHTML = `
                <label for="modeloProduto${fieldCount}" class="control-label">Compativel<span class="required">*</span></label>
                <div class="controls">
                    <input id="modeloProduto${fieldCount}" type="text" name="modeloProduto${fieldCount}" onChange="this.value=this.value.toUpperCase();" />
                    <button type="button" onclick="addField()">Adicionar</button>
                </div>
            `;

            const form = document.getElementById('dynamicForm');
            form.appendChild(newFieldGroup);

            // Remove the button from the previous field
            const previousButton = document.querySelector(`#modeloProduto${fieldCount - 1}`).nextElementSibling;
            previousButton.remove();
        }
    </script>
</body>
</html>
