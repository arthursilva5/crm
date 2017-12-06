<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Slugs_generator {
	
        public function create_slug($text)
        {
            $CI =& get_instance();
            
            /*
            $new_str = strtolower($this->remove_accent($str));
            $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $new_str);
            return $slug;
            */
              // replace non letter or digits by -
              $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

              // trim
              $text = trim($text, '-');

              // transliterate
              $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

              // lowercase
              $text = strtolower($text);

              // remove unwanted characters
              $text = preg_replace('~[^-\w]+~', '', $text);

              if (empty($text))
              {
                return 'n-a';
              }

              return $CI->session->userdata('userid').'-'.$text;       
        }
        
        
        
        public function remove_accent($str)
        {
        $a = array(
        'á','é','í','ó','ú','ý','Á','É','Í','Ó','Ú','Ý',
        'à','è','ì','ò','ù','ỳ','À','È','Ì','Ò','Ù','Ỳ',
        'ả','ẻ','ỉ','ỏ','ủ','ỷ','Ả','Ẻ','Ỉ','Ỏ','Ủ','Ỷ',
        'ã','ẽ','ĩ','õ','ũ','ỹ','Ã','Ẽ','Ĩ','Õ','Ũ','Ỹ',
        'ạ','ẹ','ị','ọ','ụ','ỵ','Ạ','Ẹ','Ị','Ọ','Ụ','Ỵ',
        'â','ê','ô','ư','Â','Ê','Ô','Ư',
        'ấ','ế','ố','ứ','Ấ','Ế','Ố','Ứ',
        'ầ','ề','ồ','ừ','Ầ','Ề','Ồ','Ừ',
        'ẩ','ể','ổ','ử','Ẩ','Ể','Ổ','Ử',
        'ậ','ệ','ộ','ự','Ậ','Ệ','Ộ','Ự'
        );
        $b = array(
        'a','e','i','o','u','y','A','E','I','O','U','Y',
        'a','e','i','o','u','y','A','E','I','O','U','Y',
        'a','e','i','o','u','y','A','E','I','O','U','Y',
        'a','e','i','o','u','y','A','E','I','O','U','Y',
        'a','e','i','o','u','y','A','E','I','O','U','Y',
        'a','e','o','u','A','E','O','U',
        'a','e','o','u','A','E','O','U',
        'a','e','o','u','A','E','O','U',
        'a','e','o','u','A','E','O','U',
        'a','e','o','u','A','E','O','U'
        );
        return str_replace($a, $b, $str);
        }           
}
