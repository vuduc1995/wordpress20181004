<?php


include('simple_html_dom.php');

/* 
 * Plugin Name: Stellissimo Text Box
 * Plugin URI: http://www.overclokk.net/stellissimo-text-box-per-wordpress
 * Description: This plugin add a box containing text/html you want show at the end of each article
 * Version: 1.1.2
 * Author: Enea Overclokk
 * Author URI: http://www.overclokk.net
 *
 * @package Stellissimo Text Box
 * @since 1.0.0
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as 
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

// ================== ADD text ================== //
add_filter('the_content', 'stellissimo_output_text_box');

function stellissimo_output_text_box($content)
{

   $return = $content;
   $return .= '<div class="stellissimo-container" style="background-color:' . get_option('stellissimo_box_bg_color') . '">
				   <p>' . get_option('stellissimo_text_content') . '</p>
               </div>';
   return $return;
}

// ================== END ADD text ================= //

// ======================= ENQUEUE REQUIRED SCRIPT AND STYLE ====================================== //
function stellissimo_enqueue_required_scripts()
{
    wp_enqueue_style('stellissimo-style', WP_PLUGIN_URL . '/stellissimo-text-box/css/style.css');
   
}
add_action('init', 'stellissimo_enqueue_required_scripts');
// ======================= END ENQUEUE REQUIRED SCRIPT AND STYLE ================================ //

// ======================== SET DEFAULT OPTION ON PLUGIN ACTIVATION =============================== //
function stellissimo_activate_set_default_options()
{

  $abc = 'ffff';
   add_option('stellissimo_text_content', 'Enter the tefffffxt or HTML code here'.$abc);
   add_option('stellissimo_box_bg_color', 'FFFfffff');
}

register_activation_hook( __FILE__, 'stellissimo_activate_set_default_options');
// ========================= END SET DEFAULT OPTION ON PLUGIN ACTIVATION ========================== //

// ======================== SET OPTIONS GROUP =================================== //
function stellissimo_register_options_group()
{
   register_setting('stellissimo_options_group', 'stellissimo_text_content');
   register_setting('stellissimo_options_group', 'stellissimo_box_bg_color');
}

add_action ('admin_init', 'stellissimo_register_options_group');
// ====================== END SET OPTIONS GROUP ================================ //


// ===================== CREATE AND ADD OPTTION PAGE =================================== //
function stellissimo_add_option_page()
{
   add_options_page('Stellissimo Options', 'Stellissimo Options', 'administrator', 'stellissimo-options-page', 'stellissimo_update_options_form');
}

function add_submenu_options2()
{
    add_submenu_page(
            'themes.php', // Menu cha
            'Nut test012', // Tiêu đề của menu
            'Nut test012', // Tên của menu
            'edit_pages',//'manage_options',// Vùng truy cập, giá trị này có ý nghĩa chỉ có supper admin và admin đc dùng
            'test-012', // Slug của menu
            'stellissimo_update_options_form' // Hàm callback hiển thị nội dung của menu
    );
}

add_action('admin_menu', 'add_submenu_options2');//stellissimo_add_option_page');

function stellissimo_update_options_form()
{
global $wpdb;
  $ketqua = $wpdb->get_results("SELECT * FROM wp_draft ");
    $laynoidung = $ketqua[7]->content;

    $hienthi = 'Noi dung: '.$laynoidung;


   ?>
   <div class="wrap">
       <div class="icon32" id="icon-options-general"><br /></div>
       <h2>Text Box Configuration</h2>
       <p>&nbsp;</p>
       <form method="post" action="options.php">
           <?php settings_fields('stellissimo_options_group'); ?>
           <table class="form-table">
               <tbody>
                   <!-- <tr valign="top"> -->
                   <!-- <th scope="row"><label for="stellissimo_box_bg_color">Box Color:</label></th> -->
                       <!-- <td>
                           <input type="text" id="stellissimo_box_bg_color" value="<?php echo get_option('stellissimo_box_bg_color'); ?>" name="stellissimo_box_bg_color" />
                           <div id="stellissimo-colorpicker"></div>  
						   <span class="description">Background color</span>
                       </td> -->
                   <!-- </tr> -->
                   <!-- <tr valign="top">
                   <th scope="row"><label for="stellissimo_box_bg_color">Box Color 222233:</label></th>
                       <td>
                           <input type="text" id="stellissimo_box_bg_color" value="<?php echo $abccc ?>" name="stellissimo_box_bg_color" />
                           <div id="stellissimo-colorpicker"></div>  
               <span class="description">Background color 22222</span>
                       </td>
                   </tr>
                    --><tr valign="top">
                       <th scope="row"><label for="stellissimo_text_content">Box Text</label></th>
                           <td>
                               <textarea id="stellissimo_text_content" name="stellissimo_text_content" style="width:400px; height:200px"><?php echo $hienthi; ?></textarea>
                               <span class="description"><br>Insert here a TEXT or HTML code, this will be show in each pages and posts</span>    
                           </td>
                   </tr>
                   <tr valign="top">
                       <th scope="row"></th>
                           <td>
                               <p class="submit">
                                   <input type="submit" class="button-primary" id="submit" name="submit" value="<?php _e('Save Changes') ?>" />
                               </p>
                           </td>
                   </tr>
                   <tr valign="top">
                       <th scope="row"><label for="stellissimo_text_content">Box Text</label></th>
                           <td>
                               <textarea id="stellissimo_text_content" name="stellissimo_text_content" style="width:400px; height:200px"><?php ; ?></textarea>
                               <span class="description"><br>Insert here a TEXT or HTML code, this will be show in each pages and posts</span>    
                           </td>
                   </tr>
                   <tr valign="top">
                       <th scope="row"></th>
                           <td>
                               <p class="submit">
                                   <input type="submit" class="button-primary" id="submit" name="submit" value="<?php _e('Save Changes') ?>" />
                               </p>
                           </td>
                   </tr>
               </tbody>
           </table>
           
       </form>
   </div>
   <?php
}
// =============================== END CREATE AND ADD OPTION PAGE =============================== //

// =============================== ADD COLORPICKER ======================================== //

function stellissimo_farbtastic_load()
{
  wp_enqueue_style( 'farbtastic' );
  wp_enqueue_script( 'farbtastic' );
}

function stellissimo_colorpicker_custom_script()
{
	?>
	<script type="text/javascript">
 
  		jQuery(document).ready(function() {
    		jQuery('#stellissimo-colorpicker').hide();
    		jQuery('#stellissimo-colorpicker').farbtastic("#stellissimo_box_bg_color");
    		jQuery("#stellissimo_box_bg_color").click(function(){jQuery('#stellissimo-colorpicker').slideToggle()});
  		});
 
	</script>
	<?php
}
if(isset($_GET['page']) AND $_GET['page'] == 'stellissimo-options-page')
{
	add_action('init', 'stellissimo_farbtastic_load');
	add_action('admin_footer', 'stellissimo_colorpicker_custom_script');
}

// ================================ END ADD COLORPICKER ===================================== //























$linkarray = array();

$html = file_get_html('https://securitydaily.net/category/daily/');

//Lấy link và thời gian của bài viết đầu tiên
$post_dau = $html->find('.td_module_mx5');
$link_dau = $post_dau[0]->children(1)->children(0)->children(0)->children(0)->children(0)->getAttribute('href');
$date_dau = $post_dau[0]->children(1)->children(0)->children(1)->children(0)->children(0)->getAttribute('datetime');
array_push($linkarray,array('link'=>$link_dau,'date'=>$date_dau));

//Lấy link của 4 bài viết tiếp theo
$post2345 = $html->find('.td_module_mx6');
for($i = 0; $i<4;$i++){
  $link = $post2345[$i]->children(1)->children(0)->children(0)->children(0)->children(0)->getAttribute('href');
  array_push($linkarray,array('link'=>$link,'date'=>''));
}

//Lấy link và thời gian của các bài viết tiếp theo
// $posts = $html->find('.td-block-span6');
// foreach ($posts as $post) {
//  $link = $post->children(0)->children(1)->children(0)->getAttribute('href');
//  $date = $post->children(0)->children(2)->children(0)->children(0)->getAttribute('datetime');
//  array_push($linkarray,array('link'=>$link,'date'=>$date));
// }

//Xóa các link đã có trong csdl
global $wpdb;
foreach($linkarray as $link){
  $ketqua = $wpdb->get_results("SELECT * FROM wp_draft WHERE link like '%" . $link['link'] . "%'");
  if(!$ketqua){
    
    $html = file_get_html($link['link']);

    //Lấy categories
    $categories = $html->find('.entry-category');
    $category_string = '';
    foreach($categories as $category){
      $category_string = $category_string.','.$category->children(0)->plaintext;
    }
    //Lấy title
    $td_title = $html->find('.td-post-title');
    $title = $td_title[0]->children(0)->plaintext;
    //Lấy date time
    $datetime = $td_title[0]->children(1)->children(0)->children(0)->getAttribute('datetime');
    //Lấy nội dung bài viết
    $content = '';
    $td_content = $html->find('.td-post-content');
    foreach($td_content[0]->children() as $child){
      if($child->tag != 'div'){
        if($child->plaintext != ''){
          $content = $content.'\n'.$child->plaintext;
        }
        $imgs = $child->find('img');
        foreach ($imgs as $img){
          $image_string = '(img)'.$img->getAttribute('src');
          $content = $content.'\n'.$image_string;
        }
      }
    }
    // Lưu vào CSDL
    $wpdb->insert( 
      'wp_draft', 
      array(
        'link' => $link['link'], 
        'date' => $datetime,
        'title'=> $title,
        'content'=>$content,
        'tag'=>$category_string
      ),
      array( 
        '%s', 
        '%s',
        '%s',
        '%s',
        '%s'
      ) 
    );

  }


}

