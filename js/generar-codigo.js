$(document).ready(function() {
    $('#tipo').change(function() {
        var selectedOption = $(this).find('option:selected');
        var areaId = selectedOption.val();
        var baseCode = selectedOption.data('codigo');
        
        if (areaId && baseCode) {
            $('#codigo-container').show();
            
            $.ajax({
                url: 'get_last_code.php',
                type: 'POST',
                data: { area_id: areaId },
                dataType: 'json',
                success: function(response) {
                    var nextNumber = 1; // Valor por defecto
                    
                    if (response.success && !isNaN(response.last_number)) {
                        nextNumber = parseInt(response.last_number) + 1;
                    }
                    
                    var newCode = baseCode + '-' + nextNumber.toString().padStart(3, '0');
                    $('#codigo').val(newCode);
                },
                error: function() {
                    $('#codigo').val(baseCode + '-001'); // Código por defecto
                }
            });
        } else {
            $('#codigo-container').hide();
            $('#codigo').val('');
        }
    });
});