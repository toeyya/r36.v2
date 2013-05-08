
      <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

      /**
 
       * CodeIgniter

       *

       * An open source application development framework for PHP 4.3.2 or newer
  
       *
 
       * @package             CodeIgniter
  
       * @author              Pradeep Kumar
 
       * @copyright   Copyright (c) 2009, hyderabad, Inc.
  
       * @license             http://tech-pundits.com/license.html
  
       * @link                http://tech-pundits.com
  
       * @since               Version 1.0
  
       * @filesource
  
       */
  
       
 
      // ————————————————————————
 
       
 
      /**
 
       * Rss Class
 
       *

       * @package             CodeIgniter

       * @subpackage  Libraries
 
       * @category    Youtube

       * @author              Pradeep Kumar

       */

      class Youtube {
 
             

              public $id = '';
 
              public $y_t_getdataurl = "http://gdata.youtube.com/feeds/api/videos/";

              public $embed_code;
  
              public $yu_image_url;

              public $file_data;
  
              public $title;
  
              public $dutation;
  
              public $height = 500;
			  
			  public $width = 300;

 
             
 
              /**
 
               * @return unknown
 
               */
  
              public function getHeight() {
  
                      return $this->height;
 
              }
  
             
 
              /**
  
               * @return unknown
  
               */
  
              public function getWidth() {
  
                      return $this->width;
  
              }
  
             
  
              /**
  
               * @param unknown_type $height
  
               */
  
              public function setHeight($height) {
  
                      $this->height = $height;
  
              }
  
             
  
              /**
  
               * @param unknown_type $width
  
               */
  
              public function setWidth($width) {
  
                      $this->width = $width;
  
              }
  
              /**
  
               * @return unknown
  
               */
  
              public function getEmbed_code() {
  
                      return $this->embed_code;
  
              }
  
             
  
              /**
  
               * @return unknown
  
               */
  
              public function getId() {
  
                      return $this->id;
  
              }
  
             
  
              /**
  
               * @return unknown
  
               */
  
              public function getY_t_getdataurl() {
  
                      return $this->y_t_getdataurl;
 
              }
 
             
 
              /**
 
               * @return unknown
 
               */
  
              public function getYu_image_url() {
  
                      return $this->yu_image_url;
 
              }
 
             
  
              /**
  
               * @return unknown

               */
 
              public function getDutation() {
 
                      return $this->dutation;
 
              }
  
             
 
              /**

               * @return unknown

               */

              public function getFile_data() {
 
                      return $this->file_data;

              }
 
             
 
              /**
 
               * @return unknown
 
               */
 
              public function getTitle() {
 
                      return $this->title;

              }

             
 
              /**
 
               * @param unknown_type $dutation
 
               */
 
              public function setDutation($dutation) {
 
                      $this->dutation = $dutation;
 
              }
 
             
 
              /**

               * @param unknown_type $file_data
 
               */
 
              public function setFile_data($file_data) {
 
                      $this->file_data = $file_data;
 
              }

             

              /**

               * @param unknown_type $title

               */

              public function setTitle($title) {
 
                      $this->title = $title;
 
              }
 
       
 
              /**
 
               * @param unknown_type $embed_code

               */

              public function setEmbed_code($embed_code) {

                      $this->embed_code = $embed_code;

              }

             

              /**

               * @param unknown_type $id

               */

              public function setId($id) {

                      $this->id = $id;

              }
 
             

              /**

               * @param unknown_type $y_t_getdataurl

               */

              public function setY_t_getdataurl($y_t_getdataurl) {

                      $this->y_t_getdataurl = $y_t_getdataurl;

              }
 
             

              /**

               * @param unknown_type $yu_image_url

               */

              public function setYu_image_url($yu_image_url) {

                      $this->yu_image_url = $yu_image_url;

              }


              /**

               * Constructor

               *

               * @access      public
 
               * @param       array   initialization parameters
 
               */
 
              function Youtube($params = array())

              {

                      if (count($params) > 0)

                      {

                              $this->initialize($params);            

                      }
 
                     

                      log_message('debug', "Flash_video Class Initialized");
 
              }

             

              // ——————————————————————–
 
             

              /**
 
               * Initialize Preferences
 
               *
 
               * @access      public

               * @param       array   initialization parameters
 
               * @return      void

               */

              function initialize($params = array())
 
              {

                      if (count($params) > 0)

                      {

                              foreach ($params as $key => $val)
 
                              {
 
                                      if (isset($this->$key))
 
                                      {

                                              $this->$key = $val;
 
                                      }
 
                              }

                      }
 
              }
 
             
 
             
 
              function getYoutubeData()
 
              {
 
                      $description ='';
 
                      $title ='';
 
                      $duration='';
					  
					  $mins = '';
 
                      $this->setY_t_getdataurl($this->getY_t_getdataurl().$this->getId());

                      $this->setFile_data(file($this->getY_t_getdataurl()));
 
                      $this->setFile_data(implode('',$this->getFile_data()));
 
                      $this->setFile_data(str_replace(array ("\r\n", "\r"), "\n", $this->getFile_data()));
 
                      preg_match('|<title [^>]*>(.*?)</title>|is', $this->getFile_data(), $title);
 
                      preg_match('|<media :description[^>]*>(.*?)</media>|is', $this->getFile_data(), $description);

                      preg_match("|<yt :duration seconds='(.*?)'/>|is", $this->getFile_data(), $duration);
 
                      $mins = @floor ($duration[1] / 60);

              $secs = @$duration[1] % 60;

                      $result = array(
 
                                                              'title'                 => $title[1],
 
                                                              'description'   => (isset($description[1])) ? $description[1] : '' ,
 
                                                              'duration'              => $mins.':'.$secs,
 
                                                      );
 
       
 
              return $result;

              }

              function getEmbededCode()
 
              {
 
                      $this->setEmbed_code('<object width="'.$this->getWidth().'" height="'.$this->getHeight().'"><param name="movie" value="http://www.youtube.com/v/'.$this->getId().'&hl=en&fs=1&"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'.$this->getId().'&hl=en&fs=1&" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="'.$this->getWidth().'" height="'.$this->getHeight().'"></embed></object>');
 
                      return $this->getEmbed_code();

              }
 
             
 
              function getImage()

              {
 
                      $this->setYu_image_url('http://img.youtube.com/vi/'.$this->getId().'/2.jpg');
 
                      return "<img src='".$this->getYu_image_url()."' width='120′ height='73′ border='0′ alt='".$this->getTitle()."' title='".$this->getTitle()."' />";
 
              }
 
  
      }

