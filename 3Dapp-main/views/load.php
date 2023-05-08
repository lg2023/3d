<?php

class  Load{
      public   function  view( $file_name ,  $data  =  null ){
          if( is_array ( $data )){
              extract ( $data );
          }
          // echo $file_name . 'php' ;
          include  $file_name . '.php'  ;
      }
}