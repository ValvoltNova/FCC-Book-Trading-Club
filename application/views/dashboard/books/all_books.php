<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
            <div id="content" class="container">
                
                <?php $this->load->view('templates/_parts/auth_books_controls_view') ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">All Books:</h1>
                        <p>Click the <i class="fa fa-retweet"></i> to request a trade!</p>
                    </div>
                </div>
                
                <div class="row">
                    <div id="books-list" class="col-md-12">
                        <?php 
                        if (isset($my_books)) {
                            foreach ($my_books as $book) { ?>
                                <div class="book col-md-1 text-center vertical-align">
                                    <?php if ($book->thumbnail_url == '') { ?>
                                        <p class="book-title"><?php echo $book->title ?></p>  
                                    <?php } else { ?>
                                        <img class="book-thumbnail" src="<?php echo $book->thumbnail_url ?>" /> 
                                    <?php } ?>  
                                        
                                    <?php 
                                    // Show trade icon only if...
                                    if (
                                        ( $this->session->userdata('user_id') != $book->user_id ) and // - book doesn't belong to user
                                        ( ! isset($book->issuer_user_id))
                                    ) { ?>
                                        <i class="book-request-trade book-control fa fa-retweet red"></i>
                                    <?php } ?>
                                    <span class="id hidden-data" style="display:none;"><?php echo $book->id ?></span>
                                </div>
                            <?php                             
                            } 
                        } ?>
                    </div>
                </div>       
                
                <script type="text/javascript" src="<?php echo site_url('assets/js/dashboard/googlebooks-viewers.js') ?>"></script>
                <script type="text/javascript">
                    $( document ).ready( function() {
                        // Book Trade
                        $( ".book-request-trade" ).click( function() {                             
                            var parent = $( this ).parent();
                            var id = parent.find( "span.id.hidden-data" ).html();
                            $.ajax({
                                type: "POST",
                                url: "<?php echo site_url('dashboard/ajax-issue-trade-request') ?>",
                                dataType: "text",
                                data: {
                                    id: id
                                },
                                success: function(result) {
                                    //alert(result);
                                    //parent.remove();
                                    location.href = '';
                                },
                                error: function(xhr, status, error) {
                                    //alert(error);
                                }
                            });                           
                        })
                    });
                </script>
                
            </div>