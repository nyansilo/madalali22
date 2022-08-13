  <script type="text/javascript">
        $('ul.pagination').addClass('no-margin pagination-sm');

        $('#title').on('blur', function() {
            var theTitle = this.value.toLowerCase().trim(),
                slugInput = $('#slug'),
                theSlug = theTitle.replace(/&/g, '-and-')
                                  .replace(/[^a-z0-9-]+/g, '-')
                                  .replace(/\-\-+/g, '-')
                                  .replace(/^-+|-+$/g, '');

            slugInput.val(theSlug);
        });

    
        var simplemde2 = new SimpleMDE({ element: $("#body")[0] });

    
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const list = new List('table-default', {
                sortClass: 'table-sort',
                listClass: 'table-tbody',
                valueNames: [ 
                     'sort-name', 'sort-type', 'sort-city', 'sort-score',
                     { attr: 'data-date', name: 'sort-date' },
                     { attr: 'data-progress', name: 'sort-progress' },
                     'sort-quantity'
                ]
            });
        })
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            //$(window).on('load', function() {
            $('select[name="category_id"]').on('change',function(){

                    var category_id = $(this).val();
                    var selectName  = $('select[name="subcategory_id"]');


                if(category_id) {
                       $.ajax({
                            url: "/get/sub-categories/"+category_id,
                            type:"GET",
                            dataType:"json",
                            // error: function(jqXHR, textStatus, errorThrown) {
                            //     alert(textStatus, errorThrown);
                            // },
                            success : function(data) {
                                 //console.log(data);
                                 selectName.empty();
                                 $.each(data, function(key, value){
                                     //console.log( key);
                                     //console.log( value );
                                     var option = '<option value="'+key+'">'+value+'</option>';


                                     selectName.append(option);
                                 });
                                selectName.trigger("chosen:updated");
                                var subCategoryVal = $("#subcategory").attr("data-selected-subcategory");
                                
                                if(subCategoryVal !== '')
                                {
                                // assign chosen data attribute value to select
                                  $("#subcategory").val(subCategoryVal);
                                }
                            },

                           
                            error: function (request, error) {
                                alert("AJAX Call Error: " + error);
                            }
                        });
                }else{
                    selectName.empty();
                }
            });
        });
         </script>
        <script type="text/javascript">
        $(document).ready(function(){
            var room = $('#room');
            var vehicle = $('#vehicle');

            room.hide();
            vehicle.hide();

            $('select[name="category_id"]').on('change',function(){

                    var category_id = $(this).val();
                    

                if(category_id === '4') {

                     vehicle.show();
                     room.hide();
                      
                }
                else if(category_id === '1') {

                     room.show();
                     vehicle.hide();
                      
                }
                else{
                    room.hide();
                    vehicle.hide();
                }
            });
        });


    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){
            //$(window).on('load', function() {
            $('select[name="region_id"]').on('change',function(){

                var region_id = $(this).val();
                var selectName = $('select[name="district_id"]');

                if(region_id) {
                    $.ajax({
                        url: "/get/districts/"+region_id,
                        type:"GET",
                        dataType:"json",

                        
                        // error: function(jqXHR, textStatus, errorThrown) {
                        //     alert(textStatus, errorThrown);
                        // },
                        success : function(data) {
                            //console.log(data);
                            selectName.empty();

                            $.each(data, function(key, value){
                                //console.log( key);
                                //console.log( value );

                            
                                var option = '<option value="'+key+'" >'+value+'</option>';


                                selectName.append(option);
                            });
                            selectName.trigger("chosen:updated");
                        },
                        error: function (data, ajaxOptions, thrownError) {
                    var status = data.status;
                    //alert(status);
                    if (data.status === 422) {
                        $.each(data.responseJSON.errors, function (key, value) {
                            $('#msg').append('<div>' + value + '</div>');
                        });
                    }}
                    });
                }else{
                    selectName.empty();
                }
            });
        });

    </script>

