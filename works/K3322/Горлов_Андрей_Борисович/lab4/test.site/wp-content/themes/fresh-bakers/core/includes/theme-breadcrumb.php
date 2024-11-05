<?php

function fresh_bakers_breadcrumb() {
    $separator = get_theme_mod('fresh_bakers_breadcrumb_separator', ' / '); // Define the separator here

    if (is_home()){
        echo "<span>Home</span>";
    }
    else if (!is_home()) {
        echo '<a href="'. home_url() .'">Home</a>' . $separator;

       if (is_archive()) {
            if (is_category()) {
                // If it's a category archive page
                echo "<span>";
                single_cat_title();
                echo "</span>";
            } elseif (is_tag()) {
                // If it's a tag archive page
                echo "<span>";
                single_tag_title();
                echo "</span>";
            } elseif (is_date()) {
                // If it's a date-based archive page
                echo "<span>";
                echo get_the_date('F Y');
                echo "</span>";
            }
            elseif (is_author()){
                echo '<span>Author: ';
                the_author();
                echo '</span>';
            }
            else {
                // For other archive pages, you can customize this part
                echo post_type_archive_title() . $separator;
            }
        }
        elseif (is_category() || is_single()) {
            // For regular posts or category pages
            the_category(', ');
            echo $separator; // Add the separator here
            if (is_single()) {
                echo "<span>";
                the_title();
                echo "</span>";
            }
        }
        elseif (is_page()) {
            // For regular pages
            echo "<span>";
            the_title();
            echo "</span>";
        }
        // Search results
        elseif (is_search()) {
            echo '<span>Search Results for: ' . get_search_query() . '</span>';
        }
        else if(is_404()){
            echo "<span>404</span>";
        }
        else{
            echo "<span>";
            the_title();
            echo "</span>";
        }
    }
}