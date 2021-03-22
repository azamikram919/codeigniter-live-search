<html lang="en-US">
    <head>
        <title>Codeigniter Autocomplete</title>

        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/themes/base/jquery-ui.css" type="text/css" media="all" />
        <link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/   css" media="all" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js" type="text/javascript"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
        <meta charset="UTF-8">
          
        <style>
            /* Autocomplete
            ----------------------------------*/
            .ui-autocomplete { position: absolute; cursor: default; }  
  
            /* workarounds */
            * html .ui-autocomplete { width:1px; } /* without this, the menu expands to 100% in IE6 */
  
            /* Menu
            ----------------------------------*/
            .ui-menu {
                list-style:none;
                padding: 2px;
                margin: 0;
                display:block;
            }
            .ui-menu .ui-menu {
                margin-top: -3px;
            }
            .ui-menu .ui-menu-item {
                margin:0;
                padding: 0;
                zoom: 1;
                float: left;
                clear: left;
                width: 100%;
                font-size:80%;
            }
            .ui-menu .ui-menu-item a {
                text-decoration:none;
                display:block;
                padding:.2em .4em;
                line-height:1.5;
                zoom:1;
            }
            .ui-menu .ui-menu-item a.ui-state-hover,
            .ui-menu .ui-menu-item a.ui-state-active {
                font-weight: normal;
                margin: -1px;
            }
        </style>
          
        
          
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6"><hr>
                    <?= form_open('autocomplete/search') ?>
                    <div class="form-group">
                        <div class="col-md-10">
                            <?= form_input(['name'=>'printable_name','id'=>'id','class'=>'form-control']) ?>
                        </div>
                    <?= form_submit(['name'=>'search','value'=>'Search','class'=>'btn btn-primary']) ?>
                    <ul>
                        <div id="result"></div>
                    </ul>
                    <?= form_close() ?>
                    <?= form_error('printable_name') ?>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><hr>
                        <h1 class="text-center">Search Results</h1>
                            <table class="table table hover table-striped table-hover">
                                <tr>
                                <th>Sr#</th>
                                <th>Country</th>
                                <th>ISO</th>
                                <th>ISO3</th>
                                <th>Code</th>
                            </tr>
                            <?php 
                            if(isset($result)):
                                $i=1;
                                foreach($result as $row):
                            ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $row->printable_name ?></td>
                                <td><?= $row->iso ?></td>
                                <td><?= $row->iso3 ?></td>
                                <td><?= $row->numcode ?></td>
                            </tr>
                            <?php 
                            endforeach;
                            else:
                            ?>
                            <tr>
                                <td colspan="5">
                                    <h2 class="text-center">No Record Found</h2>
                                </td>
                            </tr>
                            <?php
                            endif;
                            ?>
                            </table>
                        </div>
                    </div>
                <div class="col-md-3"></div>
                </div>
            
            </div>
        <script type="text/javascript">
            $(this).ready( function() {
                $("#id").autocomplete({
                    minLength: 1,
                    source: 
                    function(req, add){
                        $.ajax({
                            url: "<?php echo base_url(); ?>autocomplete/lookup",
                            dataType: 'json',
                            type: 'POST',
                            data: req,
                            success:    
                            function(data){
                                if(data.response =="true"){
                                    add(data.message);
                                }
                            },
                        });
                    },
                /*select: 
                    function(event, ui) {
                        $("#result").append(
                            "<li>"+ ui.item.value + "</li>"
                        );                  
                    },*/      
                });
            });
            </script>
            <script type="text/javascript">
            $(this).ready( function() {
                $("#id").autocomplete({
                    minLength: 1,
                    source: 
                    function(req, add){
                        $.ajax({
                            url: "<?php echo base_url(); ?>autocomplete/lookup",
                            dataType: 'json',
                            type: 'POST',
                            data: req,
                            success:    
                            function(data){
                                if(data.response =="true"){
                                    add(data.message);
                                }
                            },
                        });
                    },
                /*select: 
                    function(event, ui) {
                        $("#result").append(
                            "<li>"+ ui.item.value + "</li>"
                        );                  
                    },*/      
                });
            });
            </script>
    </body>
</html>