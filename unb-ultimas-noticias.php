<?php/*Plugin Name: Ultimas NoticiasPlugin URI: https://wordpress.org/plugins/ultimas-noticias/Description: Muestra las Ultimas Noticias en el hambito internacional, para manternet tu sitio web o blog actualizadoVersion: 2.1Author: Bibliatodo.comAuthor URI: https://www.bibliatodo.comLicense: GPL2Copyright 2017 BibliaTodo.com (email : bibliatodo1@gmail.com)This program is free software; you can redistribute it and/or modifyit under the terms of the GNU General Public License, version 2, aspublished by the Free Software Foundation.This program is distributed in the hope that it will be useful,but WITHOUT ANY WARRANTY; without even the implied warranty ofMERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See theGNU General Public License for more details.You should have received a copy of the GNU General Public Licensealong with this program; if not, write to the Free SoftwareFoundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA*/function unb_ultimas_funcion_noticias($showlink, $language) {	if($language == 'en'){		$languageUrl = 'https://www.bibliatodo.com/assets/js/wordpress/es/widget-news.js';	}	else{		$languageUrl = 'https://www.bibliatodo.com/assets/js/wordpress/es/widget-news.js';	}		$html = '<div>';	$html .= '<script type="text/javascript" language="javascript" src="'.$languageUrl.'"></script>';	/*if ($showlink == 1){		$html .= '<p style="text-align: center;"><a href="https://www.bibliatodo.com" target="_blank">Bibliatodo.com</a></p>';	}*/ 	$html .= '</div>';	return $html;}add_shortcode('unb_ultimas_noticias', 'unb_ultimas_funcion_noticias');class unb_ultimas_noticiasWidget extends WP_Widget{	function __construct()	{		parent::__construct('unb_ultimas_noticiasWidget', __('Ultimas Noticias', 'unb_ultimas_noticias' ), array ('description' => __( 'Este plugin muestra en tu sitio web las ultimas noticias en el hambito internacional, todos los dias nuestros editores publican las mejores noticias para mantener tu sitio actualizado.', 'unb_ultimas_noticias')));	}	function form($instance)	{		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Ultimas Noticias', 'showlink' => '1', 'language' => 'es' ) );		$title = $instance['title'];		$showlink = $instance['showlink'];		$language = $instance['language'];?><p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="vdd_widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo$this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p><p><select id="<?php echo $this->get_field_id('language'); ?>" name="<?php echo $this->get_field_name('language'); ?>"><option value="es" <?php _e($language == '' || $language == 'es' ? 'selected' : ''); ?>>Español</option><!--<option value="en" <?php _e($language == 'en' ? 'selected' : ''); ?>>Ingles</option>--></select></p><p><input id="<?php echo $this->get_field_id('showlink'); ?>" name="<?php echo $this->get_field_name('showlink'); ?>" type="checkbox" value="1" <?php checked( '1',$showlink ); ?>/><label for="<?php echo $this->get_field_id('showlink'); ?>"><?php _e('&nbsp;Show link to BibliaTodo.com (thank you!)'); ?></label></p><?php	}	function update($new_instance, $old_instance)	{		$instance = $old_instance;		$instance['title'] = $new_instance['title'];		if($new_instance['showlink'] == '1')		{			$instance['showlink'] = '1';		}		else		{			$instance['showlink'] = '0';		}		$instance['language'] = $new_instance['language'];		return $instance;	}	function widget($args, $instance)	{		extract($args, EXTR_SKIP);		echo $before_widget;		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);		if (!empty($title))			echo $before_title . $title . $after_title;;		$showlink = $instance['showlink'];		$language = $instance['language'];		echo unb_ultimas_funcion_noticias($showlink, $language);		echo $after_widget;	}}add_action( 'widgets_init', create_function('', 'return register_widget("unb_ultimas_noticiasWidget");') );?>