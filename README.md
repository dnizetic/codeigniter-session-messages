# codeigniter-session-messages
Provides a messaging system based on CI session


Session based messaging system.

Most basic usage:

$this->message->set("Success message!");
...redirect...
$this->message->show();

Calling show() will remove the message from session so it can only be called once.
If you want to keep the message, call it with $return parameter set to true.


#####################
Using set_custom():

Define possible message views inside config/message.php:
  $config['message_view_types'] = array(
  '0' => 'message_views/msg_err',
  '1' => 'message_views/msg_succ',
  '2' => 'message_views/msg_warning'
  );

$this->message->set_custom(0, "Error message!");
... redirect

Now show() will load appropriate view file under '0' key as defined in config/message.php 
(message_views/msg_err).
$this->message->show();

If multiple messages are needed to be shown on same page, $key parameter
can be changed.

$additional parameter can be used if more data is needed to be
passed to the custom view.
