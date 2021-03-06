<?php

/**
 * This template displays the ACADP listings in grid view.
 *
 * @link    https://pluginsware.com
 * @since   1.0.0
 *
 * @package Advanced_Classifieds_And_Directory_Pro
 */
?>

<div class="acadp acadp-listings acadp-grid-view">
	<?php if ( $can_show_header ) : ?>
		<!-- header here -->
        <?php if ( ! empty( $pre_content ) ) echo '<p>' . wp_kses_post( $pre_content ) . '</p>'; ?>
        
    	<div class="row acadp-no-margin">
        	<?php if ( $can_show_listings_count ) : ?>
    			<!-- total items count -->
    			<div class="pull-left text-muted">
    				<?php 
                    $count = ( is_front_page() && is_home() ) ? $acadp_query->post_count : $acadp_query->found_posts;
                    printf( esc_html__( "%d item(s) found", 'advanced-classifieds-and-directory-pro' ), $count );
					?>
				</div>
            <?php endif; ?>
        
    		<div class="btn-toolbar pull-right" role="toolbar">
            	<?php if ( $can_show_views_selector ) : ?> 
      				<!-- Views dropdown -->
      				<div class="btn-group" role="group">
                    	<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    						<?php esc_html_e( "View as", 'advanced-classifieds-and-directory-pro' ); ?> <span class="caret"></span>
  						</button>
                        <ul class="dropdown-menu">
                        	<?php
                            $views = acadp_get_listings_view_options();
                            
                            foreach ( $views as $value => $label ) {
                                $active_class = ( 'grid' == $value ) ? ' active' : '';							
                                printf( '<li class="acadp-no-margin%s"><a href="%s">%s</a></li>', $active_class, esc_url( add_query_arg( 'view', $value ) ), esc_html( $label ) );
                            }
							?>
                        </ul>
       				</div>
                <?php endif; ?>
        
        		<?php if ( $can_show_orderby_dropdown ) : ?> 
       				<!-- Orderby dropdown -->
       				<div class="btn-group" role="group">
  						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    						<?php esc_html_e( "Sort by", 'advanced-classifieds-and-directory-pro' ); ?> <span class="caret"></span>
  						</button>
  						<ul class="dropdown-menu">
            				<?php
                            $options = acadp_get_listings_orderby_options();
            
                            foreach ( $options as $value => $label ) {
                                $active_class = ( $value == $current_order ) ? ' active' : '';							
                                printf( '<li class="acadp-no-margin%s"><a href="%s">%s</a></li>', $active_class, esc_url( add_query_arg( 'sort', $value ) ), esc_html( $label ) );
                            }
							?>
  						</ul>
					</div>
                <?php endif; ?>
    		</div>
		</div>
    <?php endif; ?>
    
	
	
	
	
	
	
	
	
    
	<!-- LOOP -->

<div class="row slick-carroucel">        
		<?php 
        $columns = $listings_settings['columns'];
        $span = 'col-md-' . floor( 12 / $columns );
        $i = 0; 
        
        while ( $acadp_query->have_posts() ) : 
            $acadp_query->the_post(); 
            $post_meta = get_post_meta( $post->ID );
            ?>
            

        <div class="card shadow m-3 col-md-3 p-0">
            <div class="mx-auto">
                <a href="<?php the_permalink(); ?>" class="acadp-responsive-container"><?php the_acadp_listing_thumbnail( $post_meta ); ?></a>
            </div>
            <div class="border-top p-2 px-4">
                <span class="lead acadp-listings-price">R$795.000,00</span>        		               
                <div class="w-100"></div>
            </div>
            <div class="card-footer bg-white border-top-0 border pt-0">
                <small class="text-muted">
                    <a style="text-decoration:none; color:gray" href="https://www.tudoclassificados.com/anuncio/casa-com-3-dormitorios-a-venda-193-m%c2%b2-por-r-795-00000-vila-padre-anchieta-diadema-sp/"></a>
                </small>
            </div>
        </div>
        <div class="card shadow m-3 col-md-3 p-0"></div>
        <div class="card shadow m-3 col-md-3 p-0"></div>
        <div class="card shadow m-3 col-md-3 p-0"></div>
        <div class="card shadow m-3 col-md-3 p-0"></div>
    

    
    
    
    
            

    
            <?php if ( $i % $columns == 0 ) : ?>
                <div class="row">
            <?php endif; ?>            
                <div class="<?php echo esc_attr( $span ); ?>">
                    <div <?php the_acadp_listing_entry_class( $post_meta, 'thumbnail' ); ?>>
                        <?php if ( $can_show_images ) : ?>
                            <a href="<?php the_permalink(); ?>" class="acadp-responsive-container"><?php the_acadp_listing_thumbnail( $post_meta ); ?></a>      	
                        <?php endif; ?>
                
                        <div class="caption">
                            <div class="acadp-listings-title-block">
                                <h3 class="acadp-no-margin"><a href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_title() ); ?></a></h3>
                                <?php the_acadp_listing_labels( $post_meta ); ?>
                            </div>
                            
                            <?php
                            $info = array();					
        
                            if ( $can_show_date ) {
                                $info[] = sprintf( esc_html__( 'Posted %s ago', 'advanced-classifieds-and-directory-pro' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) );
                            }
                            
                            if ( $can_show_user ) {			
                                $info[] = '<a href="' . esc_url( acadp_get_user_page_link( $post->post_author ) ) . '">' . get_the_author() . '</a>';
                            }

                            echo '<p class="acadp-no-margin"><small class="text-muted">' . implode( ' ' . esc_html__( "by", 'advanced-classifieds-and-directory-pro' ) . ' ', $info ) . '</small></p>';
                            ?>
                            
                            <?php if ( ! empty( $listings_settings['excerpt_length'] ) && ! empty( $post->post_content ) ) : ?>
                                <p class="acadp-listings-desc"><?php echo wp_trim_words( $post->post_content, $listings_settings['excerpt_length'], '...' ); ?></p>
                            <?php endif; ?>
                            
                            <?php
                            $info = array();					
        
                            if ( $can_show_category && $categories = wp_get_object_terms( $post->ID, 'acadp_categories' ) ) {
                                $category_links = array();
                                foreach ( $categories as $category ) {						
                                    $category_links[] = sprintf( '<a href="%s">%s</a>', esc_url( acadp_get_category_page_link( $category ) ), esc_html( $category->name ) );						
                                }
                                $info[] = sprintf( '<span class="glyphicon glyphicon-briefcase"></span>&nbsp;%s', implode( ', ', $category_links ) );
                            }
                    
                            if ( $can_show_location && $locations = wp_get_object_terms( $post->ID, 'acadp_locations' ) ) {
                                $location_links = array();
                                foreach ( $locations as $location ) {						
                                    $location_links[] = sprintf( '<a href="%s">%s</a>', esc_url( acadp_get_location_page_link( $location ) ), esc_html( $location->name ) );						
                                }
                                $info[] = sprintf( '<span class="glyphicon glyphicon-map-marker"></span>&nbsp;%s', implode( ', ', $location_links ) );
                            }
                            
                            if ( 'acadp_favourite_listings' == $shortcode ) {
                                $info[] = '<a href="' . esc_url( acadp_get_remove_favourites_page_link( $post->ID ) ) . '">' . esc_html__( 'Remove from favourites', 'advanced-classifieds-and-directory-pro' ) . '</a>';
                            }
                    
                            if ( $can_show_views && ! empty( $post_meta['views'][0] ) ) {
                                $info[] = sprintf( esc_html__( "%d views", 'advanced-classifieds-and-directory-pro' ), $post_meta['views'][0] );
                            }

                            echo '<p class="acadp-no-margin"><small>' . implode( ' / ', $info ) . '</small></p>';
    
                            if ( $can_show_price && isset( $post_meta['price'] ) && $post_meta['price'][0] > 0 ) {
                                $price = acadp_format_amount( $post_meta['price'][0] );						
                                echo '<p class="lead acadp-listings-price">' . esc_html( acadp_currency_filter( $price ) ) . '</p>';
                            }            		
                            ?>
                            
                            <?php do_action( 'acadp_after_listing_content', $post->ID, 'grid' ); ?>
                        </div>
                    </div>
                </div>
                
            <?php 
            $i++;
            if( $i % $columns == 0 || $i == $acadp_query->post_count ) : ?>
                </div>
            <?php endif; ?>                   
        <?php endwhile; ?>
    </div>
    <!-- end of the loop -->
    
    <!-- Use reset postdata to restore orginal query -->
    <?php wp_reset_postdata(); ?>
    
    <!-- pagination here -->
    <?php //if ( $can_show_pagination ) the_acadp_pagination( $acadp_query->max_num_pages, "", $paged ); ?>
</div>

<?php the_acadp_social_sharing_buttons(); ?>









<script>
    $(function(){
    $('.slick-carroucel').slick({
        //dots: true,
        speed: 700,
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        
        autoplay: true,
        autoplaySpeed: 3000,
        adaptiveHeight: true,
        
        centerMode: true,
        
        responsive: 
        [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});
</script>







