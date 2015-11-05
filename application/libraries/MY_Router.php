<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 4/4/13
 * Time: 8:21 PM
 * To change this template use File | Settings | File Templates.
 */

Class MY_Router extends CI_Router
{

    Function MY_Router()
    {
        parent::CI_Router();
    }

    function _validate_request($segments)
    {

        if (file_exists(APPPATH.'controllers/'.$segments[0].EXT))

        {

        return $segments;
        }

        if (is_dir(APPPATH.'controllers/'.$segments[0]))

        {

            $this->set_directory($segments[0]);

            $segments = array_slice($segments, 1);


            while(count($segments) > 0 && is_dir(APPPATH.'controllers/'.$this->directory.$segments[0]))

            {

                $this->set_directory($this->directory . $segments[0]);

                $segments = array_slice($segments, 1);

            }



            if (count($segments) > 0)

            {
                if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().$segments[0].EXT))
                 {

                    show_404($this->fetch_directory().$segments[0]); /* show 404 page */

                 }
            }

        else
        {

            $this->set_class($this->default_controller);

            $this->set_method('index');

            if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().$this->default_controller.EXT))

            {

                $this->directory = '';

                return array();

            }

        }

        return $segments;

        }

    }

}

?>
