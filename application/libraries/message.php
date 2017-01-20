<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Session based messaging system.
 * 
 * Most basic usage:
 * 
 * $this->message->set("Success message!");
 * ...redirect...
 * $this->message->show();
 * 
 * Calling show() will remove the message from session so it can only be called once.
 * If you want to keep the message, call it with $return parameter set to true.
 * 
 * 
 * #####################
 * Using set_custom():
 * 
 * Define possible message views inside config/message.php:
  $config['message_view_types'] = array(
  '0' => 'message_views/msg_err',
  '1' => 'message_views/msg_succ',
  '2' => 'message_views/msg_warning'
  );
 * 
 * $this->message->set_custom(0, "Error message!");
 * ... redirect
 * 
 * Now show() will load appropriate view file under '0' key as defined in config/message.php 
 * (message_views/msg_err).
 * $this->message->show();
 * 
 * If multiple messages are needed to be shown on same page, $key parameter
 * can be changed.
 * 
 * $additional parameter can be used if more data is needed to be
 * passed to the custom view.
 */
class My_message {

    /**
     * Variable containing a reference to the Codeigniter instance.
     *
     * @access private
     * @var    object
     */
    private $CI;
    private $view_types = [];

    /**
     * Constructor method, called whenever the library is loaded using $this->load->library()
     *
     * @access	public
     * @param   array $config Associative array containing all configuration options.
     * @return  object
     */
    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('session');
        $this->CI->load->config('message');
        $this->view_types = $this->CI->config->item('message_view_types');
    }

    public function set($text, $key = '_custom_msg') {

        $this->CI->session->set_userdata($key, array(
            'text' => $text,
            'view_type' => null,
            'additional' => array()
        ));
    }

    /**
     * When showing custom message, a view is loaded instead of plain text.
     * Variables available in view are $msg and $msg_additional. $msg
     * contains the message text, and latter variable contains additional
     * data.
     * $view_type indicates view path that will be included, 
     * which is defined in config/message.php.
     * $additional data can be provided to the custom view.
     * @param string $view_type
     * @param string $text
     * @param string $key
     * @param array $additional
     */
    public function set_custom($view_type, $text, $key = '_custom_msg', $additional = array()) {

        $this->CI->session->set_userdata($key, array(
            'text' => $text,
            'view_type' => $view_type,
            'additional' => $additional
        ));
    }

    /**
     * If set_custom() was used, a view will be loaded instead of plain text.
     * Variable availables inside custom view are $msg and $msg_additional.
     * @param type $key
     * @param type $return Whether to return the message, or display it.
     * @return type
     */
    public function show($key = '_custom_msg', $return = false) {
        $message = $this->CI->session->userdata($key);
        $view_type = $message['view_type'];

        if (!$message['view_type']) {
            $output = $message['text'];
        } else {
            $output = $this->CI->load->view($this->view_types[$view_type], array(
                'msg' => $message['text'],
                'msg_additional' => $message['additional']), TRUE);
        }

        $this->CI->session->unset_userdata($key);

        if ($return) {
            return $output;
        } else {
            echo $output;
        }
    }

}
