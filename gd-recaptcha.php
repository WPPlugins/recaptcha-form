<?php
/*
Plugin Name: reCAPTCHA Form
Plugin URI: http://plugins.gattdesign.co.uk/wordpress-plugins/recaptcha-form
Version: 1.11
Author: Gatt Design
Author URI: http://plugins.gattdesign.co.uk
Description: This plugin enables you to use a reCAPTCHA contact form on your blog.

 Copyright 2009 Gatt Design  (email : plugins@gattdesign.co.uk)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// admin sidebar menu option
add_action('admin_menu', 'gatt_design_recaptcha_plugin_menu');

// admin plugin menu
function gatt_design_recaptcha_plugin_menu() {
	add_options_page('reCAPTCHA Form Settings', 'reCAPTCHA Form', 8, __FILE__, 'gatt_design_recaptcha_plugin_settings');
}

//checks theme colour in db, returns theme colour and admin form option list (selected="selected") status in array
function gatt_design_recaptcha_plugin_theme_checka($gatt_design_recaptcha_plugin_theme_parameter) {
	$gatt_design_recaptcha_plugin_theme_db_entry = get_option('gd_recap_theme');
	$gatt_design_recaptcha_plugin_theme_selected = ' selected="selected"';
	
	$gatt_design_recaptcha_plugin_theme_postback = array('selected' => '', 'colour' => '');
	
	switch($gatt_design_recaptcha_plugin_theme_db_entry) {
		case true:
			switch($gatt_design_recaptcha_plugin_theme_parameter) {
				case ($gatt_design_recaptcha_plugin_theme_parameter == 'red' || $gatt_design_recaptcha_plugin_theme_parameter == 'gd_recap_theme_red'):
					if($gatt_design_recaptcha_plugin_theme_db_entry == 'gd_recap_theme_red') {
						$gatt_design_recaptcha_plugin_theme_postback['selected'] = $gatt_design_recaptcha_plugin_theme_selected;
						$gatt_design_recaptcha_plugin_theme_postback['colour'] = 'red';
					}
					
					break;
				
				case ($gatt_design_recaptcha_plugin_theme_parameter == 'blackglass' || $gatt_design_recaptcha_plugin_theme_parameter == 'gd_recap_theme_blackglass'):
					if($gatt_design_recaptcha_plugin_theme_db_entry == 'gd_recap_theme_blackglass') {
						$gatt_design_recaptcha_plugin_theme_postback['selected'] = $gatt_design_recaptcha_plugin_theme_selected;
						$gatt_design_recaptcha_plugin_theme_postback['colour'] = 'blackglass';
					}
					
					break;
				
				case ($gatt_design_recaptcha_plugin_theme_parameter == 'clean' || $gatt_design_recaptcha_plugin_theme_parameter == 'gd_recap_theme_clean'):
					if($gatt_design_recaptcha_plugin_theme_db_entry == 'gd_recap_theme_clean') {
						$gatt_design_recaptcha_plugin_theme_postback['selected'] = $gatt_design_recaptcha_plugin_theme_selected;
						$gatt_design_recaptcha_plugin_theme_postback['colour'] = 'clean';
					}
					
					break;
					
				case ($gatt_design_recaptcha_plugin_theme_parameter == 'white' || $gatt_design_recaptcha_plugin_theme_parameter == 'gd_recap_theme_white'):
					if($gatt_design_recaptcha_plugin_theme_db_entry == 'gd_recap_theme_white') {
						$gatt_design_recaptcha_plugin_theme_postback['selected'] = $gatt_design_recaptcha_plugin_theme_selected;
						$gatt_design_recaptcha_plugin_theme_postback['colour'] = 'white';
					}
					
					break;
			}
			
			break;
			
		default:
			break;
	}
	
	return $gatt_design_recaptcha_plugin_theme_postback;
}

// returns theme colour as variable
function gatt_design_recaptcha_plugin_theme_colour($gatt_design_recaptcha_plugin_theme_colour_parameter) {
	$gatt_design_recaptcha_plugin_theme_function = gatt_design_recaptcha_plugin_theme_checka($gatt_design_recaptcha_plugin_theme_colour_parameter);
	$gatt_design_recaptcha_plugin_theme_function = $gatt_design_recaptcha_plugin_theme_function['colour'];
	
	return $gatt_design_recaptcha_plugin_theme_function;
}

// returns theme colour admin form option list (selected="selected") status
function gatt_design_recaptcha_plugin_theme_selected($gatt_design_recaptcha_plugin_theme_selected_parameter) {
	$gatt_design_recaptcha_plugin_theme_select = gatt_design_recaptcha_plugin_theme_checka($gatt_design_recaptcha_plugin_theme_selected_parameter);
	$gatt_design_recaptcha_plugin_theme_select = $gatt_design_recaptcha_plugin_theme_select['selected'];
	
	return $gatt_design_recaptcha_plugin_theme_select;
}

//checks language in db, returns admin form option list (selected="selected") status in variable
function gatt_design_recaptcha_plugin_language_checka($gatt_design_recaptcha_plugin_language_parameter) {
	$gatt_design_recaptcha_plugin_language_db_entry = get_option('gd_recap_language');
	$gatt_design_recaptcha_plugin_language_selected = ' selected="selected"';
	$gatt_design_recaptcha_plugin_language_postback = '';
	
	switch($gatt_design_recaptcha_plugin_language_db_entry) {
		case true:
			switch($gatt_design_recaptcha_plugin_language_parameter) {
				case 'english':
					if($gatt_design_recaptcha_plugin_language_db_entry == 'gd_recap_language_english') $gatt_design_recaptcha_plugin_language_postback = $gatt_design_recaptcha_plugin_language_selected;
					break;
				
				case 'dutch':
					if($gatt_design_recaptcha_plugin_language_db_entry == 'gd_recap_language_dutch') $gatt_design_recaptcha_plugin_language_postback = $gatt_design_recaptcha_plugin_language_selected;
					break;
				
				case 'french':
					if($gatt_design_recaptcha_plugin_language_db_entry == 'gd_recap_language_french') $gatt_design_recaptcha_plugin_language_postback = $gatt_design_recaptcha_plugin_language_selected;
					break;
				
				case 'german':
					if($gatt_design_recaptcha_plugin_language_db_entry == 'gd_recap_language_german') $gatt_design_recaptcha_plugin_language_postback = $gatt_design_recaptcha_plugin_language_selected;
					break;
				
				case 'portuguese':
					if($gatt_design_recaptcha_plugin_language_db_entry == 'gd_recap_language_portuguese') $gatt_design_recaptcha_plugin_language_postback = $gatt_design_recaptcha_plugin_language_selected;
					break;
				
				case 'russian':
					if($gatt_design_recaptcha_plugin_language_db_entry == 'gd_recap_language_russian') $gatt_design_recaptcha_plugin_language_postback = $gatt_design_recaptcha_plugin_language_selected;
					break;
				
				case 'spanish':
					if($gatt_design_recaptcha_plugin_language_db_entry == 'gd_recap_language_spanish') $gatt_design_recaptcha_plugin_language_postback = $gatt_design_recaptcha_plugin_language_selected;
					break;
				
				case 'turkish':
					if($gatt_design_recaptcha_plugin_language_db_entry == 'gd_recap_language_turkish') $gatt_design_recaptcha_plugin_language_postback = $gatt_design_recaptcha_plugin_language_selected;
					break;	
			}
			
			break;
			
		default:
			break;
	}
	
	return $gatt_design_recaptcha_plugin_language_postback;
}

// returns current language, and form fields text as array
function gatt_design_recaptcha_plugin_current_language($gatt_design_recaptcha_plugin_current_language_parameter) {
	$gatt_design_recaptcha_plugin_current_language_postback = array('language' => '', 'client_name' => '', 'client_email' => '', 'client_message' => '', 'submit_button' => '', 'invalid_recaptcha' => '', 'fill_in_fields' => '', 'message_sent' => '', 'message_failed' => '');
	
	switch($gatt_design_recaptcha_plugin_current_language_parameter) {
		case 'gd_recap_language_english':
			$gatt_design_recaptcha_plugin_current_language_postback['language'] = 'en';
			$gatt_design_recaptcha_plugin_current_language_postback['client_name'] = 'Your Name:';
			$gatt_design_recaptcha_plugin_current_language_postback['client_email'] = 'Your Email Address:';
			$gatt_design_recaptcha_plugin_current_language_postback['client_message'] = 'Your Message:';
			$gatt_design_recaptcha_plugin_current_language_postback['submit_button'] = 'Submit';
			$gatt_design_recaptcha_plugin_current_language_postback['invalid_recaptcha'] = 'Invalid reCAPTCHA phrase - please try again.';
			$gatt_design_recaptcha_plugin_current_language_postback['fill_in_fields'] = 'Please fill in ALL fields.';
			$gatt_design_recaptcha_plugin_current_language_postback['message_sent'] = 'Your message has been sent.';
			$gatt_design_recaptcha_plugin_current_language_postback['message_failed'] = 'Your message could not be sent at this time.';
			
			break;
			
		case 'gd_recap_language_dutch':
			$gatt_design_recaptcha_plugin_current_language_postback['language'] = 'nl';
			$gatt_design_recaptcha_plugin_current_language_postback['client_name'] = 'Uw Naam:';
			$gatt_design_recaptcha_plugin_current_language_postback['client_email'] = 'Uw Emailadres:';
			$gatt_design_recaptcha_plugin_current_language_postback['client_message'] = 'Uw Bericht:';
			$gatt_design_recaptcha_plugin_current_language_postback['submit_button'] = 'Verstuur';
			$gatt_design_recaptcha_plugin_current_language_postback['invalid_recaptcha'] = 'Incorrecte waarden voor reCAPTCHA.  Probeer het opnieuw.';
			$gatt_design_recaptcha_plugin_current_language_postback['fill_in_fields'] = 'Vul alle velden in.';
			$gatt_design_recaptcha_plugin_current_language_postback['message_sent'] = 'Uw bericht is verzonden.';
			$gatt_design_recaptcha_plugin_current_language_postback['message_failed'] = 'Je bericht kan niet worden verzonden op dit moment.';
			
			break;
			
		case 'gd_recap_language_french':
			$gatt_design_recaptcha_plugin_current_language_postback['language'] = 'fr';
			$gatt_design_recaptcha_plugin_current_language_postback['client_name'] = 'Votre Nom:';
			$gatt_design_recaptcha_plugin_current_language_postback['client_email'] = 'Votre Email:';
			$gatt_design_recaptcha_plugin_current_language_postback['client_message'] = 'Votre Message:';
			$gatt_design_recaptcha_plugin_current_language_postback['submit_button'] = 'Envoyer';
			$gatt_design_recaptcha_plugin_current_language_postback['invalid_recaptcha'] = 'Valeur incorrecte pour reCAPTCHA.  S\'il-vous-pla&icirc;t, essayez de nouveau.';
			$gatt_design_recaptcha_plugin_current_language_postback['fill_in_fields'] = 'S\'il vous pla&icirc;t remplir tous les champs.';
			$gatt_design_recaptcha_plugin_current_language_postback['message_sent'] = 'Votre message a &eacute;t&eacute; envoy&eacute;.';
			$gatt_design_recaptcha_plugin_current_language_postback['message_failed'] = 'Votre message n\'a pas pu &ecirc;tre envoy&eacute; en ce moment.';
			
			break;
			
		case 'gd_recap_language_german':
			$gatt_design_recaptcha_plugin_current_language_postback['language'] = 'de';
			$gatt_design_recaptcha_plugin_current_language_postback['client_name'] = 'Ihr Name:';
			$gatt_design_recaptcha_plugin_current_language_postback['client_email'] = 'Ihre Email-Adresse:';
			$gatt_design_recaptcha_plugin_current_language_postback['client_message'] = 'Ihre Nachricht:';
			$gatt_design_recaptcha_plugin_current_language_postback['submit_button'] = '&Uuml;bermitteln';
			$gatt_design_recaptcha_plugin_current_language_postback['invalid_recaptcha'] = 'Falscher reCAPTCHA Satz - Bitte versuchen Sie es erneut.';
			$gatt_design_recaptcha_plugin_current_language_postback['fill_in_fields'] = 'Bitte ALLE Felder ausfüllen.';
			$gatt_design_recaptcha_plugin_current_language_postback['message_sent'] = 'Ihre Nachricht wurde verschickt.';
			$gatt_design_recaptcha_plugin_current_language_postback['message_failed'] = 'Ihre nachricht konnte nicht abgesendet werden.';
			
			break;
			
		case 'gd_recap_language_portuguese':
			$gatt_design_recaptcha_plugin_current_language_postback['language'] = 'pt';
			$gatt_design_recaptcha_plugin_current_language_postback['client_name'] = 'O seu Nome:';
			$gatt_design_recaptcha_plugin_current_language_postback['client_email'] = 'O seu Endere&ccedil;o de Email:';
			$gatt_design_recaptcha_plugin_current_language_postback['client_message'] = 'A Sua Mensagem:';
			$gatt_design_recaptcha_plugin_current_language_postback['submit_button'] = 'Enviar';
			$gatt_design_recaptcha_plugin_current_language_postback['invalid_recaptcha'] = 'A frase reCAPTCHA inválida - por favor tente novamente.';
			$gatt_design_recaptcha_plugin_current_language_postback['fill_in_fields'] = 'Por favor preencha todos os campos.';
			$gatt_design_recaptcha_plugin_current_language_postback['message_sent'] = 'A sua mensagem foi enviada.';
			$gatt_design_recaptcha_plugin_current_language_postback['message_failed'] = 'A sua mensagem não pode ser enviada neste momento.';
			
			break;
			
		case 'gd_recap_language_russian':
			$gatt_design_recaptcha_plugin_current_language_postback['language'] = 'ru';
			$gatt_design_recaptcha_plugin_current_language_postback['client_name'] = 'Ваше имя:';
			$gatt_design_recaptcha_plugin_current_language_postback['client_email'] = 'Ваш адрес электронной почты:';
			$gatt_design_recaptcha_plugin_current_language_postback['client_message'] = 'Ваше сообщение:';
			$gatt_design_recaptcha_plugin_current_language_postback['submit_button'] = 'Отправить';
			$gatt_design_recaptcha_plugin_current_language_postback['invalid_recaptcha'] = 'Неправильная reCAPTCHA фраза - пожалуйста попробуйте еще раз.';
			$gatt_design_recaptcha_plugin_current_language_postback['fill_in_fields'] = 'Пожалуйста заполните ВСЕ поля.';
			$gatt_design_recaptcha_plugin_current_language_postback['message_sent'] = 'Ваше сообщение отправлено.';
			$gatt_design_recaptcha_plugin_current_language_postback['message_failed'] = 'Ваше сообщение не было отправлено.';
			
			break;
			
		case 'gd_recap_language_spanish':
			$gatt_design_recaptcha_plugin_current_language_postback['language'] = 'es';
			$gatt_design_recaptcha_plugin_current_language_postback['client_name'] = 'Tu Nombre:';
			$gatt_design_recaptcha_plugin_current_language_postback['client_email'] = 'Tu Direcci&oacute;n De Email:';
			$gatt_design_recaptcha_plugin_current_language_postback['client_message'] = 'Tu Mensaje:';
			$gatt_design_recaptcha_plugin_current_language_postback['submit_button'] = 'Enviar';
			$gatt_design_recaptcha_plugin_current_language_postback['invalid_recaptcha'] = 'La frase de reCAPTCHA es incorrecta. Por favor, int&eacute;ntelo de nuevo.';
			$gatt_design_recaptcha_plugin_current_language_postback['fill_in_fields'] = 'Por favor, rellene TODOS los campos.';
			$gatt_design_recaptcha_plugin_current_language_postback['message_sent'] = 'Tu mensaje se ha enviado.';
			$gatt_design_recaptcha_plugin_current_language_postback['message_failed'] = 'Tu mensaje no podría ser enviado en este momento.';
			
			break;
			
		case 'gd_recap_language_turkish':
			$gatt_design_recaptcha_plugin_current_language_postback['language'] = 'tr';
			$gatt_design_recaptcha_plugin_current_language_postback['client_name'] = 'Isminiz:';
			$gatt_design_recaptcha_plugin_current_language_postback['client_email'] = 'Email Adresiniz:';
			$gatt_design_recaptcha_plugin_current_language_postback['client_message'] = 'Mesaj&iota;n&iota;z:';
			$gatt_design_recaptcha_plugin_current_language_postback['submit_button'] = 'G&ouml;nder';
			$gatt_design_recaptcha_plugin_current_language_postback['invalid_recaptcha'] = 'L&uuml;tfen reCAPTCHA (resim)/g&ouml;rd&uuml;&#287;&uuml;n&uuml;z karakterleri aynen giriniz.';
			$gatt_design_recaptcha_plugin_current_language_postback['fill_in_fields'] = 'L&uuml;tfen b&uuml;t&uuml;n alanlar&iota; doldurun.';
			$gatt_design_recaptcha_plugin_current_language_postback['message_sent'] = 'Mesaj&iota;n&iota;z g&ouml;nderildi.';
			$gatt_design_recaptcha_plugin_current_language_postback['message_failed'] = 'Mesaj&iota;n&iota;z g&ouml;nderilemedi.';
			
			break;
	}
	
	return $gatt_design_recaptcha_plugin_current_language_postback;
}



// admin plugin functions
function gatt_design_recaptcha_plugin_settings() {
	// form submitted
	if(isset($_POST['recaptcha_admin'])) {
		$gatt_design_recaptcha_public_checka = false;
		$gatt_design_recaptcha_private_checka = false;
		$gatt_design_recaptcha_public = get_option('gd_recap_publickey');
		$gatt_design_recaptcha_private = get_option('gd_recap_privatekey');

		// public key
		switch($gatt_design_recaptcha_public) {
			case false:
				if(add_option('gd_recap_publickey', 'Public Key Goes Here', '', 'no')) {
					$gatt_design_recaptcha_public_checka = 'no_key';
				} else {
					update_option('gd_recap_publickey', 'Public Key Goes Here');
					$gatt_design_recaptcha_public = get_option('gd_recap_publickey');
					$gatt_design_recaptcha_public_checka = 'no_key';
				}
				
				break;
				
			case true:
				$gatt_design_recaptcha_form_opt_pub = $_POST['gd_recap_publickey'];
				
				if($gatt_design_recaptcha_form_opt_pub == 'Public Key Goes Here') {
					$gatt_design_recaptcha_public_checka = 'no_key';
				} else {
					if(($gatt_design_recaptcha_form_opt_pub == null) || (empty($gatt_design_recaptcha_form_opt_pub))) {
						update_option('gd_recap_publickey', 'Public Key Goes Here');
						$gatt_design_recaptcha_public = get_option('gd_recap_publickey');
						$gatt_design_recaptcha_public_checka = 'no_key';						
					} else {
						update_option('gd_recap_publickey', $gatt_design_recaptcha_form_opt_pub);
						$gatt_design_recaptcha_public = get_option('gd_recap_publickey');
						$gatt_design_recaptcha_public_checka = 'yes_key';
					}
				}
				break;
		}
		
		// private key
		switch($gatt_design_recaptcha_private) {
			case false:
				if(add_option('gd_recap_privatekey', 'Private Key Goes Here', '', 'no')) {
					$gatt_design_recaptcha_private_checka = 'no_key';
				} else {
					update_option('gd_recap_privatekey', 'Private Key Goes Here');
					$gatt_design_recaptcha_private = get_option('gd_recap_privatekey');
					$gatt_design_recaptcha_private_checka = 'no_key';
				}
				
				break;
				
			case true:
				$gatt_design_recaptcha_form_opt_pri = $_POST['gd_recap_privatekey'];
				
				if($gatt_design_recaptcha_form_opt_pri == 'Private Key Goes Here') {
					$gatt_design_recaptcha_private_checka = 'no_key';
				} else {
					if(($gatt_design_recaptcha_form_opt_pri == null) || (empty($gatt_design_recaptcha_form_opt_pri))) {
						update_option('gd_recap_privatekey', 'Private Key Goes Here');
						$gatt_design_recaptcha_private = get_option('gd_recap_privatekey');
						$gatt_design_recaptcha_private_checka = 'no_key';						
					} else {
						update_option('gd_recap_privatekey', $gatt_design_recaptcha_form_opt_pri);
						$gatt_design_recaptcha_private = get_option('gd_recap_privatekey');
						$gatt_design_recaptcha_private_checka = 'yes_key';
					}
				}
				break;
		}
		
		// theme
		$gatt_design_recaptcha_form_opt_theme = $_POST['gd_recap_theme'];
		
		if(add_option('gd_recap_theme', $gatt_design_recaptcha_form_opt_theme, '', 'no')) {
			$gatt_design_recaptcha_theme = $gatt_design_recaptcha_form_opt_theme;
		} else {
			update_option('gd_recap_theme', $gatt_design_recaptcha_form_opt_theme);
			$gatt_design_recaptcha_theme = $gatt_design_recaptcha_form_opt_theme;
		}
		
		// language
		$gatt_design_recaptcha_form_opt_language = $_POST['gd_recap_language'];
		
		if(add_option('gd_recap_language', $gatt_design_recaptcha_form_opt_language, '', 'no')) {
			$gatt_design_recaptcha_language = $gatt_design_recaptcha_form_opt_language;
		} else {
			update_option('gd_recap_language', $gatt_design_recaptcha_form_opt_language);
			$gatt_design_recaptcha_language = $gatt_design_recaptcha_form_opt_language;
		}
		
	// form not submitted
	} else {
		$gatt_design_recaptcha_public_checka = false;
		$gatt_design_recaptcha_private_checka = false;
		$gatt_design_recaptcha_public = get_option('gd_recap_publickey');
		$gatt_design_recaptcha_private = get_option('gd_recap_privatekey');
		$gatt_design_recaptcha_theme = get_option('gd_recap_theme');
		$gatt_design_recaptcha_language = get_option('gd_recap_language');

		// public key
		switch($gatt_design_recaptcha_public) {
			case false:
				if(add_option('gd_recap_publickey', 'public key', '', 'no')) {
					add_option('gd_recap_publickey', 'Public Key Goes Here', '', 'no');
					$gatt_design_recaptcha_public_checka = 'no_key';
				} else {
					update_option('gd_recap_publickey', 'Public Key Goes Here');
					$gatt_design_recaptcha_public = get_option('gd_recap_publickey');
					$gatt_design_recaptcha_public_checka = 'no_key';
				}
				
				break;
				
			case true:
				if($gatt_design_recaptcha_public == 'Public Key Goes Here') {
					$gatt_design_recaptcha_public_checka = 'no_key';
				} elseif($gatt_design_recaptcha_public == null) {
					update_option('gd_recap_publickey', 'Public Key Goes Here');
					$gatt_design_recaptcha_public_checka = 'no_key';
				} else {
					$gatt_design_recaptcha_public_checka = 'do_nothing';
				}
				
				break;
		}
		
		// private key
		switch($gatt_design_recaptcha_private) {
			case false:
				if(add_option('gd_recap_privatekey', 'Private Key Goes Here', '', 'no')) {
					$gatt_design_recaptcha_private_checka = 'no_key';
				} else {
					update_option('gd_recap_privatekey', 'Private Key Goes Here');
					$gatt_design_recaptcha_private = get_option('gd_recap_privatekey');
					$gatt_design_recaptcha_private_checka = 'no_key';
				}
				
				break;
				
			case true:
				if($gatt_design_recaptcha_private == 'Private Key Goes Here') {
					$gatt_design_recaptcha_private_checka = 'no_key';
				} elseif($gatt_design_recaptcha_private == null) {
					update_option('gd_recap_privatekey', 'Private Key Goes Here');
					$gatt_design_recaptcha_private_checka = 'no_key';
				} else {
					$gatt_design_recaptcha_private_checka = 'do_nothing';
				}
				
				break;
		}
		
		// theme
		switch($gatt_design_recaptcha_theme) {
			case false:
				if(add_option('gd_recap_theme', 'gd_recap_theme_red', '', 'no')) {
					// added option
				} else {
					update_option('gd_recap_theme', 'gd_recap_theme_red');
				}
				
				break;
		}
		
		// language
		switch($gatt_design_recaptcha_language) {
			case false:
				if(add_option('gd_recap_language', 'gd_recap_language_english', '', 'no')) {
					// added option
				} else {
					update_option('gd_recap_language', 'gd_recap_language_english');
				}
				
				break;
		}
		
	}
	
	// display appropriate message
	if(($gatt_design_recaptcha_private_checka == 'no_key') || ($gatt_design_recaptcha_public_checka == 'no_key')){
?>
<div class="error"><p><strong><?php _e('Please populate the required fields.', 'recaptcha_plugin_menu' ); ?></strong></p></div>
<?php	
	} elseif(($gatt_design_recaptcha_private_checka == 'do_nothing') && ($gatt_design_recaptcha_public_checka == 'do_nothing')) {
		// do nothing
	} else {
?>
<div class="updated"><p><strong><?php _e('Settings updated.', 'recaptcha_plugin_menu' ); ?></strong></p></div>
<?php	
	}
?>
<div class="wrap">
	<h2>reCAPTCHA Form</h2>
	<h3>Settings</h3>
	<form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<?php wp_nonce_field('update-options'); ?>
		
		<table class="form-table">
			<tr valign="top">
				<th scope="row">reCAPTCHA public key</th>
				<td>
					<input type="text" name="gd_recap_publickey" value="<?php echo $gatt_design_recaptcha_public; ?>" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">reCAPTCHA private key</th>
				<td>
					<input type="text" name="gd_recap_privatekey" value="<?php echo $gatt_design_recaptcha_private; ?>" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Theme</th>
				<td>
					<select name="gd_recap_theme">
						<option value="gd_recap_theme_red"<?php echo gatt_design_recaptcha_plugin_theme_selected('red'); ?>>Red</option>
						<option value="gd_recap_theme_blackglass"<?php echo gatt_design_recaptcha_plugin_theme_selected('blackglass'); ?>>Blackglass</option>
						<option value="gd_recap_theme_clean"<?php echo gatt_design_recaptcha_plugin_theme_selected('clean'); ?>>Clean</option>
						<option value="gd_recap_theme_white"<?php echo gatt_design_recaptcha_plugin_theme_selected('white'); ?>>White</option>								
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Language</th>
				<td>
					<select name="gd_recap_language">
						<option value="gd_recap_language_english"<?php echo gatt_design_recaptcha_plugin_language_checka('english'); ?>>English</option>
						<option value="gd_recap_language_dutch"<?php echo gatt_design_recaptcha_plugin_language_checka('dutch'); ?>>Dutch</option>
						<option value="gd_recap_language_french"<?php echo gatt_design_recaptcha_plugin_language_checka('french'); ?>>French</option>
						<option value="gd_recap_language_german"<?php echo gatt_design_recaptcha_plugin_language_checka('german'); ?>>German</option>
						<option value="gd_recap_language_portuguese"<?php echo gatt_design_recaptcha_plugin_language_checka('portuguese'); ?>>Portuguese</option>
						<option value="gd_recap_language_russian"<?php echo gatt_design_recaptcha_plugin_language_checka('russian'); ?>>Russian</option>
						<option value="gd_recap_language_spanish"<?php echo gatt_design_recaptcha_plugin_language_checka('spanish'); ?>>Spanish</option>
						<option value="gd_recap_language_turkish"<?php echo gatt_design_recaptcha_plugin_language_checka('turkish'); ?>>Turkish</option>
					</select>
				</td>
			</tr>
		</table>
		
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="gd_recap_privatekey" />
		<input type="hidden" name="page_options" value="gd_recap_publickey" />
		<input type="hidden" name="page_options" value="gd_recap_theme" />
		<input type="hidden" name="page_options" value="gd_recap_language" />
		<p class="submit"><input type="submit" class="button-primary" name="recaptcha_admin" value="<?php _e('Save Changes') ?>" /></p>
	</form>
	
	<p><b>NOTE:</b> If you haven't already got reCAPTCHA public and private keys, you can get them by visiting the <a href="http://recaptcha.net/whyrecaptcha.html">reCAPTCHA website</a>.</p>

	<h3>Usage</h3>
	<p>Simply use the shortcode <b>[recaptcha_form]</b> in any of your posts or pages.  All emails submitted from the reCAPTCHA forms will be sent to the blog administrator's email address (<a href="mailto:<?php echo get_option('admin_email'); ?>"><?php echo get_option('admin_email'); ?></a>).</p>


	<h3>Styling The reCAPTCHA Form</h3>
	<p>There is a seperate CSS file, <b>recaptcha-form.css</b>, which can be edited to modify the styling of the form objects.  You can edit this file by going to <b>Plugins &raquo; Editor</b> on the sidebar menu.</p>
	
	
	<h3>Did You Find This Plugin Useful?</h3>
	<p>Stay up to date with the latest plugin developments by visiting the <a href="http://plugins.gattdesign.co.uk">Gatt Design Plugins website</a>.</p>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_s-xclick" />
		<input type="hidden" name="hosted_button_id" value="5159812" />
		<input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_donate_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online." />
		<img alt="" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1" />
	</form>	
	<p>We provide this plugin completely free of charge to the WordPress community, so feel free to drop us a line to say thank you or even make a small donation towards the continued development of this plugin! :-)</p>
</div>
<?php
}

// shortcode and message handling functions
function gatt_design_recaptcha_short_code() {
	$gatt_design_recaptcha_privkey_checka = get_option('gd_recap_privatekey');
	$gatt_design_recaptcha_pubkey_checka = get_option('gd_recap_publickey');
	$gatt_design_recaptcha_theme_value = get_option('gd_recap_theme');
	
	$gatt_design_recaptcha_language_value = get_option('gd_recap_language');
	$gatt_design_recaptcha_language_fields = gatt_design_recaptcha_plugin_current_language($gatt_design_recaptcha_language_value);
	
	// one or both keys are invalid	
	if(($gatt_design_recaptcha_privkey_checka == 'Private Key Goes Here') || ($gatt_design_recaptcha_pubkey_checka == 'Public Key Goes Here')) {
		$gatt_design_recaptcha_form_code = '';
	// one or both keys are empty	
	} elseif(($gatt_design_recaptcha_privkey_checka == null) || ($gatt_design_recaptcha_pubkey_checka == null)) {
		$gatt_design_recaptcha_form_code = '';
	// both keys are valid
	} else {
		// message has been submitted
		if(isset($_POST['recaptcha_client'])) {
			// include reCAPTCHA library (only if it hasn't been declared elsewhere)
			if(!is_callable(recaptcha_check_answer)) require_once('recaptchalib.php');
			
			// check reCAPTCHA response
			$gatt_design_recaptcha_response = recaptcha_check_answer ($gatt_design_recaptcha_privkey_checka, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
			
			// recaptcha challenge failed, show error message and contact form
			if (!$gatt_design_recaptcha_response->is_valid) {
				$gatt_design_recaptcha_form_code = '<!-- start of recaptcha form -->' . "\n";
				$gatt_design_recaptcha_form_code .= '<p class="recaptcha_form_p recaptcha_form_p_error">' . $gatt_design_recaptcha_language_fields['invalid_recaptcha'] . '</p>' . "\n";
				$gatt_design_recaptcha_form_code .= '<br />' . "\n";
				$gatt_design_recaptcha_form_code .= '<script type="text/javascript">' . "\n";
				$gatt_design_recaptcha_form_code .= 'var RecaptchaOptions = {' . "\n";
				$gatt_design_recaptcha_form_code .= 'theme: \'' . gatt_design_recaptcha_plugin_theme_colour($gatt_design_recaptcha_theme_value) . '\',' . "\n";
				$gatt_design_recaptcha_form_code .= 'lang: \'' . $gatt_design_recaptcha_language_fields['language'] . '\'' . "\n";
				$gatt_design_recaptcha_form_code .= '};' . "\n";
				$gatt_design_recaptcha_form_code .= '</script>' . "\n";
				$gatt_design_recaptcha_form_code .= '<noscript>&nbsp;</noscript>' . "\n";
				$gatt_design_recaptcha_form_code .= '<form method="post" action="' . str_replace( '%7E', '~', $_SERVER['REQUEST_URI']) . '">' . "\n";
				$gatt_design_recaptcha_form_code .= '<fieldset class="recaptcha_form_fieldset">' . "\n";
				$gatt_design_recaptcha_form_code .= '<p class="recaptcha_form_p">' . $gatt_design_recaptcha_language_fields['client_name'] . '<br /><label for="recaptcha_form_name"><input type="text" name="recaptcha_form_name" value="" class="recaptcha_form_input" /></label></p>' . "\n";
				$gatt_design_recaptcha_form_code .= '<p class="recaptcha_form_p">' . $gatt_design_recaptcha_language_fields['client_email'] . '<br /><label for="recaptcha_form_email"><input type="text" name="recaptcha_form_email" value="" class="recaptcha_form_input" /></label></p>' . "\n";
				$gatt_design_recaptcha_form_code .= '<p class="recaptcha_form_p">' . $gatt_design_recaptcha_language_fields['client_message'] . '<br /><label for="recaptcha_form_message"><textarea name="recaptcha_form_message" rows="10" cols="20" class="recaptcha_form_textarea"></textarea></label></p>' . "\n";
				$gatt_design_recaptcha_form_code .= '<script type="text/javascript" src="http://api.recaptcha.net/challenge?k=' . $gatt_design_recaptcha_pubkey_checka . '"></script>' . "\n";
				$gatt_design_recaptcha_form_code .= '<noscript>' . "\n";
				$gatt_design_recaptcha_form_code .= '<div id="gatt_design_recaptcha_plugin">' . "\n";
				$gatt_design_recaptcha_form_code .= '<object data="http://api.recaptcha.net/noscript?k=' . $gatt_design_recaptcha_pubkey_checka . '" type="text/html" id="gatt_design_recaptcha_plugin_object" class="recaptcha_form_captcha_box">' . "\n";
				$gatt_design_recaptcha_form_code .= '<!--[if IE]>' . "\n";
				$gatt_design_recaptcha_form_code .= '<object classid="clsid:235336920-03F9-11CF-8FD0-00AA00686F13" data="http://api.recaptcha.net/noscript?k=' . $gatt_design_recaptcha_pubkey_checka . '" type="text/html" id="gatt_design_recaptcha_plugin_object" class="recaptcha_form_captcha_box">' . "\n";
				$gatt_design_recaptcha_form_code .= '<p>&nbsp;</p>' . "\n";
				$gatt_design_recaptcha_form_code .= '</object>' . "\n";
				$gatt_design_recaptcha_form_code .= '<![endif]-->' . "\n";
				$gatt_design_recaptcha_form_code .= '<p>&nbsp;</p>' . "\n";
				$gatt_design_recaptcha_form_code .= '</object>' . "\n";
				$gatt_design_recaptcha_form_code .= '</div>' . "\n";
				$gatt_design_recaptcha_form_code .= '<br />' . "\n";
				$gatt_design_recaptcha_form_code .= '<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>' . "\n";
				$gatt_design_recaptcha_form_code .= '<input type="hidden" name="recaptcha_response_field" value="manual_challenge" />' . "\n";
				$gatt_design_recaptcha_form_code .= '</noscript>' . "\n";
				$gatt_design_recaptcha_form_code .= '<br />' . "\n";
				$gatt_design_recaptcha_form_code .= '<p class="recaptcha_form_p"><input type="submit" name="recaptcha_client" value="' . $gatt_design_recaptcha_language_fields['submit_button'] . '" /></p>' . "\n";
				$gatt_design_recaptcha_form_code .= '</fieldset>' . "\n";
				$gatt_design_recaptcha_form_code .= '</form>' . "\n";
				$gatt_design_recaptcha_form_code .= '<!-- end of recaptcha form -->' . "\n";
			// recaptcha challenge passed
			} else {
				$gatt_design_recaptcha_form_name_field = $_POST['recaptcha_form_name'];
				$gatt_design_recaptcha_form_email_field = $_POST['recaptcha_form_email'];
				$gatt_design_recaptcha_form_email_field = sanitize_email($gatt_design_recaptcha_form_email_field);
				$gatt_design_recaptcha_form_message_field = $_POST['recaptcha_form_message'];
				
				// some fields are empty, show error message and contact form
				if(($gatt_design_recaptcha_form_name_field == null) || ($gatt_design_recaptcha_form_email_field == null) || ($gatt_design_recaptcha_form_message_field == null)) {
					$gatt_design_recaptcha_form_code = '<!-- start of recaptcha form -->' . "\n";
					$gatt_design_recaptcha_form_code .= '<p class="recaptcha_form_p recaptcha_form_p_error">' . $gatt_design_recaptcha_language_fields['fill_in_fields'] .'</p>' . "\n";
					$gatt_design_recaptcha_form_code .= '<br />' . "\n";
					$gatt_design_recaptcha_form_code .= '<script type="text/javascript">' . "\n";
					$gatt_design_recaptcha_form_code .= 'var RecaptchaOptions = {' . "\n";
					$gatt_design_recaptcha_form_code .= 'theme: \'' . gatt_design_recaptcha_plugin_theme_colour($gatt_design_recaptcha_theme_value) . '\',' . "\n";
					$gatt_design_recaptcha_form_code .= 'lang: \'' . $gatt_design_recaptcha_language_fields['language'] . '\'' . "\n";
					$gatt_design_recaptcha_form_code .= '};' . "\n";
					$gatt_design_recaptcha_form_code .= '</script>' . "\n";
					$gatt_design_recaptcha_form_code .= '<noscript>&nbsp;</noscript>' . "\n";
					$gatt_design_recaptcha_form_code .= '<form method="post" action="' . str_replace( '%7E', '~', $_SERVER['REQUEST_URI']) . '">' . "\n";
					$gatt_design_recaptcha_form_code .= '<fieldset class="recaptcha_form_fieldset">' . "\n";
					$gatt_design_recaptcha_form_code .= '<p class="recaptcha_form_p">' . $gatt_design_recaptcha_language_fields['client_name'] . '<br /><label for="recaptcha_form_name"><input type="text" name="recaptcha_form_name" value="" class="recaptcha_form_input" /></label></p>' . "\n";
					$gatt_design_recaptcha_form_code .= '<p class="recaptcha_form_p">' . $gatt_design_recaptcha_language_fields['client_email'] . '<br /><label for="recaptcha_form_email"><input type="text" name="recaptcha_form_email" value="" class="recaptcha_form_input" /></label></p>' . "\n";
					$gatt_design_recaptcha_form_code .= '<p class="recaptcha_form_p">' . $gatt_design_recaptcha_language_fields['client_message'] . '<br /><label for="recaptcha_form_message"><textarea name="recaptcha_form_message" rows="10" cols="20" class="recaptcha_form_textarea"></textarea></label></p>' . "\n";
					$gatt_design_recaptcha_form_code .= '<script type="text/javascript" src="http://api.recaptcha.net/challenge?k=' . $gatt_design_recaptcha_pubkey_checka . '"></script>' . "\n";
					$gatt_design_recaptcha_form_code .= '<noscript>' . "\n";
					$gatt_design_recaptcha_form_code .= '<div id="gatt_design_recaptcha_plugin">' . "\n";
					$gatt_design_recaptcha_form_code .= '<object data="http://api.recaptcha.net/noscript?k=' . $gatt_design_recaptcha_pubkey_checka . '" type="text/html" id="gatt_design_recaptcha_plugin_object" class="recaptcha_form_captcha_box">' . "\n";
					$gatt_design_recaptcha_form_code .= '<!--[if IE]>' . "\n";
					$gatt_design_recaptcha_form_code .= '<object classid="clsid:235336920-03F9-11CF-8FD0-00AA00686F13" data="http://api.recaptcha.net/noscript?k=' . $gatt_design_recaptcha_pubkey_checka . '" type="text/html" id="gatt_design_recaptcha_plugin_object" class="recaptcha_form_captcha_box">' . "\n";
					$gatt_design_recaptcha_form_code .= '<p>&nbsp;</p>' . "\n";
					$gatt_design_recaptcha_form_code .= '</object>' . "\n";
					$gatt_design_recaptcha_form_code .= '<![endif]-->' . "\n";
					$gatt_design_recaptcha_form_code .= '<p>&nbsp;</p>' . "\n";
					$gatt_design_recaptcha_form_code .= '</object>' . "\n";
					$gatt_design_recaptcha_form_code .= '</div>' . "\n";
					$gatt_design_recaptcha_form_code .= '<br />' . "\n";
					$gatt_design_recaptcha_form_code .= '<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>' . "\n";
					$gatt_design_recaptcha_form_code .= '<input type="hidden" name="recaptcha_response_field" value="manual_challenge" />' . "\n";
					$gatt_design_recaptcha_form_code .= '</noscript>' . "\n";
					$gatt_design_recaptcha_form_code .= '<br />' . "\n";
					$gatt_design_recaptcha_form_code .= '<p class="recaptcha_form_p"><input type="submit" name="recaptcha_client" value="' . $gatt_design_recaptcha_language_fields['submit_button'] . '" /></p>' . "\n";
					$gatt_design_recaptcha_form_code .= '</fieldset>' . "\n";
					$gatt_design_recaptcha_form_code .= '</form>' . "\n";
					$gatt_design_recaptcha_form_code .= '<!-- end of recaptcha form -->' . "\n";
				// all fields have input, send email and display confirmation message
				} else {
					// construct mail 
					$gatt_design_recaptcha_email_sender = 'From: ' . $gatt_design_recaptcha_form_name_field . ' <' . $gatt_design_recaptcha_form_email_field . '>';
					$gatt_design_recaptcha_email_receiver = get_option('blogname') . ' <' . get_option('admin_email') . '>';
					$gatt_design_recaptcha_email_body = 'You have received a message from ' . get_option('blogname') . '.  Message details are as follows:' . "\n\n";
					$gatt_design_recaptcha_email_body .= 'Date and Time: ' . date("l jS F Y H:i:s") . "\n\n";
					$gatt_design_recaptcha_email_body .= 'IP address: ' . $_SERVER['REMOTE_ADDR'] . ' (' . gethostbyaddr($_SERVER['REMOTE_ADDR']) . ')' . "\n\n";
					$gatt_design_recaptcha_email_body .= 'Message: ' . $gatt_design_recaptcha_form_message_field;
					
					//mail sent
					if(wp_mail($gatt_design_recaptcha_email_receiver, 'New Message From ' . get_option('blogname'), $gatt_design_recaptcha_email_body, $gatt_design_recaptcha_email_sender)) {
						$gatt_design_recaptcha_form_code = '<!-- start of recaptcha form -->' . "\n";
						$gatt_design_recaptcha_form_code .= '<p class="recaptcha_form_p recaptcha_form_p_info">' . $gatt_design_recaptcha_language_fields['message_sent'] . '</p>' . "\n";
						$gatt_design_recaptcha_form_code .= '<!-- end of recaptcha form -->' . "\n";
					// problem sending mail
					} else {
						$gatt_design_recaptcha_form_code = '<!-- start of recaptcha form -->' . "\n";
						$gatt_design_recaptcha_form_code .= '<p class="recaptcha_form_p recaptcha_form_p_error">' . $gatt_design_recaptcha_language_fields['message_failed'] . '</p>' . "\n";
						$gatt_design_recaptcha_form_code .= '<!-- end of recaptcha form -->' . "\n";
					}
				}
			}
		// message hasn't been submitted, display contact form
		} else {
			$gatt_design_recaptcha_form_code = '<!-- start of recaptcha form -->' . "\n";
			$gatt_design_recaptcha_form_code .= '<script type="text/javascript">' . "\n";
			$gatt_design_recaptcha_form_code .= 'var RecaptchaOptions = {' . "\n";
			$gatt_design_recaptcha_form_code .= 'theme: \'' . gatt_design_recaptcha_plugin_theme_colour($gatt_design_recaptcha_theme_value) . '\',' . "\n";
			$gatt_design_recaptcha_form_code .= 'lang: \'' . $gatt_design_recaptcha_language_fields['language'] . '\'' . "\n";
			$gatt_design_recaptcha_form_code .= '};' . "\n";
			$gatt_design_recaptcha_form_code .= '</script>' . "\n";
			$gatt_design_recaptcha_form_code .= '<noscript>&nbsp;</noscript>' . "\n";
			$gatt_design_recaptcha_form_code .= '<form method="post" action="' . str_replace( '%7E', '~', $_SERVER['REQUEST_URI']) . '">' . "\n";
			$gatt_design_recaptcha_form_code .= '<fieldset class="recaptcha_form_fieldset">' . "\n";
			$gatt_design_recaptcha_form_code .= '<p class="recaptcha_form_p">' . $gatt_design_recaptcha_language_fields['client_name'] . '<br /><label for="recaptcha_form_name"><input type="text" name="recaptcha_form_name" value="" class="recaptcha_form_input" /></label></p>' . "\n";
			$gatt_design_recaptcha_form_code .= '<p class="recaptcha_form_p">' . $gatt_design_recaptcha_language_fields['client_email'] . '<br /><label for="recaptcha_form_email"><input type="text" name="recaptcha_form_email" value="" class="recaptcha_form_input" /></label></p>' . "\n";
			$gatt_design_recaptcha_form_code .= '<p class="recaptcha_form_p">' . $gatt_design_recaptcha_language_fields['client_message'] . '<br /><label for="recaptcha_form_message"><textarea name="recaptcha_form_message" rows="10" cols="20" class="recaptcha_form_textarea"></textarea></label></p>' . "\n";
			$gatt_design_recaptcha_form_code .= '<script type="text/javascript" src="http://api.recaptcha.net/challenge?k=' . $gatt_design_recaptcha_pubkey_checka . '"></script>' . "\n";
			$gatt_design_recaptcha_form_code .= '<noscript>' . "\n";
			$gatt_design_recaptcha_form_code .= '<div id="gatt_design_recaptcha_plugin">' . "\n";
			$gatt_design_recaptcha_form_code .= '<object data="http://api.recaptcha.net/noscript?k=' . $gatt_design_recaptcha_pubkey_checka . '" type="text/html" id="gatt_design_recaptcha_plugin_object" class="recaptcha_form_captcha_box">' . "\n";
			$gatt_design_recaptcha_form_code .= '<!--[if IE]>' . "\n";
			$gatt_design_recaptcha_form_code .= '<object classid="clsid:235336920-03F9-11CF-8FD0-00AA00686F13" data="http://api.recaptcha.net/noscript?k=' . $gatt_design_recaptcha_pubkey_checka . '" type="text/html" id="gatt_design_recaptcha_plugin_object" class="recaptcha_form_captcha_box">' . "\n";
			$gatt_design_recaptcha_form_code .= '<p>&nbsp;</p>' . "\n";
			$gatt_design_recaptcha_form_code .= '</object>' . "\n";
			$gatt_design_recaptcha_form_code .= '<![endif]-->' . "\n";
			$gatt_design_recaptcha_form_code .= '<p>&nbsp;</p>' . "\n";
			$gatt_design_recaptcha_form_code .= '</object>' . "\n";
			$gatt_design_recaptcha_form_code .= '</div>' . "\n";
			$gatt_design_recaptcha_form_code .= '<br />' . "\n";
			$gatt_design_recaptcha_form_code .= '<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>' . "\n";
			$gatt_design_recaptcha_form_code .= '<input type="hidden" name="recaptcha_response_field" value="manual_challenge" />' . "\n";
			$gatt_design_recaptcha_form_code .= '</noscript>' . "\n";
			$gatt_design_recaptcha_form_code .= '<br />' . "\n";
			$gatt_design_recaptcha_form_code .= '<p class="recaptcha_form_p"><input type="submit" name="recaptcha_client" value="' . $gatt_design_recaptcha_language_fields['submit_button'] . '" /></p>' . "\n";
			$gatt_design_recaptcha_form_code .= '</fieldset>' . "\n";
			$gatt_design_recaptcha_form_code .= '</form>' . "\n";
			$gatt_design_recaptcha_form_code .= '<!-- end of recaptcha form -->' . "\n";
		}
	}
	
	return $gatt_design_recaptcha_form_code;
}

// create the shortcode
add_shortcode('recaptcha_form', 'gatt_design_recaptcha_short_code');

// include css file
function gatt_design_recaptcha_css() {
	echo '<link rel="stylesheet" type="text/css" media="screen, print" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/recaptcha-form/gd-recaptcha.css" />' . "\n";
}

add_action('wp_head', 'gatt_design_recaptcha_css');

?>