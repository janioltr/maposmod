


<body>
    <div class="span8 control-group">
        <div class="span12">
            <label for="precoCompra" class="control-label">Preço de Compra<span class="required">*</span></label>
            <div class="controls">
                <input id="precoCompra" class="money span12" data-affixes-stay="true" data-thousands="" data-decimal="." type="text" name="precoCompra" value="<?php echo set_value('precoCompra'); ?>" />
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.money').maskMoney({
                prefix: '',
                allowNegative: false,
                thousands: '',
                decimal: '.',
                affixesStay: true
            });

            // Forçar a aplicação da máscara ao focar no campo (para dispositivos móveis)
            $('.money').on('focus', function() {
                $(this).maskMoney('mask');
            });
        });
    </script>
</body>
