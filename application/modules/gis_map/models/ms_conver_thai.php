<?php
class Ms_conver_thai extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_last_ten_entries()
    {
        $query = $this->db->get('entries', 10);
        return $query->result();
    }

    function insert_entry()
    {
        $this->title   = $_POST['title']; // please read the below note
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->insert('entries', $this);
    }

    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }
	
function ThaiToUtf8($string)
{
    if(false == preg_match('#[\241-\377]#i', $string))
    {
        return $string;
    }
    return strtr($string, array("\xa1" => "\xe0\xb8\x81",
                                "\xa2" => "\xe0\xb8\x82",
                                "\xa3" => "\xe0\xb8\x83",
                                "\xa4" => "\xe0\xb8\x84",
                                "\xa5" => "\xe0\xb8\x85",
                                "\xa6" => "\xe0\xb8\x86",
                                "\xa7" => "\xe0\xb8\x87",
                                "\xa8" => "\xe0\xb8\x88",
                                "\xa9" => "\xe0\xb8\x89",
                                "\xaa" => "\xe0\xb8\x8a",
                                "\xab" => "\xe0\xb8\x8b",
                                "\xac" => "\xe0\xb8\x8c",
                                "\xad" => "\xe0\xb8\x8d",
                                "\xae" => "\xe0\xb8\x8e",
                                "\xaf" => "\xe0\xb8\x8f",
                                "\xb0" => "\xe0\xb8\x90",
                                "\xb1" => "\xe0\xb8\x91",
                                "\xb2" => "\xe0\xb8\x92",
                                "\xb3" => "\xe0\xb8\x93",
                                "\xb4" => "\xe0\xb8\x94",
                                "\xb5" => "\xe0\xb8\x95",
                                "\xb6" => "\xe0\xb8\x96",
                                "\xb7" => "\xe0\xb8\x97",
                                "\xb8" => "\xe0\xb8\x98",
                                "\xb9" => "\xe0\xb8\x99",
                                "\xba" => "\xe0\xb8\x9a",
                                "\xbb" => "\xe0\xb8\x9b",
                                "\xbc" => "\xe0\xb8\x9c",
                                "\xbd" => "\xe0\xb8\x9d",
                                "\xbe" => "\xe0\xb8\x9e",
                                "\xbf" => "\xe0\xb8\x9f",
                                "\xc0" => "\xe0\xb8\xa0",
                                "\xc1" => "\xe0\xb8\xa1",
                                "\xc2" => "\xe0\xb8\xa2",
                                "\xc3" => "\xe0\xb8\xa3",
                                "\xc4" => "\xe0\xb8\xa4",
                                "\xc5" => "\xe0\xb8\xa5",
                                "\xc6" => "\xe0\xb8\xa6",
                                "\xc7" => "\xe0\xb8\xa7",
                                "\xc8" => "\xe0\xb8\xa8",
                                "\xc9" => "\xe0\xb8\xa9",
                                "\xca" => "\xe0\xb8\xaa",
                                "\xcb" => "\xe0\xb8\xab",
                                "\xcc" => "\xe0\xb8\xac",
                                "\xcd" => "\xe0\xb8\xad",
                                "\xce" => "\xe0\xb8\xae",
                                "\xcf" => "\xe0\xb8\xaf",
                                "\xd0" => "\xe0\xb8\xb0",
                                "\xd1" => "\xe0\xb8\xb1",
                                "\xd2" => "\xe0\xb8\xb2",
                                "\xd3" => "\xe0\xb8\xb3",
                                "\xd4" => "\xe0\xb8\xb4",
                                "\xd5" => "\xe0\xb8\xb5",
                                "\xd6" => "\xe0\xb8\xb6",
                                "\xd7" => "\xe0\xb8\xb7",
                                "\xd8" => "\xe0\xb8\xb8",
                                "\xd9" => "\xe0\xb8\xb9",
                                "\xda" => "\xe0\xb8\xba",
                                "\xdf" => "\xe0\xb8\xbf",
                                "\xe0" => "\xe0\xb9\x80",
                                "\xe1" => "\xe0\xb9\x81",
                                "\xe2" => "\xe0\xb9\x82",
                                "\xe3" => "\xe0\xb9\x83",
                                "\xe4" => "\xe0\xb9\x84",
                                "\xe5" => "\xe0\xb9\x85",
                                "\xe6" => "\xe0\xb9\x86",
                                "\xe7" => "\xe0\xb9\x87",
                                "\xe8" => "\xe0\xb9\x88",
                                "\xe9" => "\xe0\xb9\x89",
                                "\xea" => "\xe0\xb9\x8a",
                                "\xeb" => "\xe0\xb9\x8b",
                                "\xec" => "\xe0\xb9\x8c",
                                "\xed" => "\xe0\xb9\x8d",
                                "\xee" => "\xe0\xb9\x8e",
                                "\xef" => "\xe0\xb9\x8f",
                                "\xf0" => "\xe0\xb9\x90",
                                "\xf1" => "\xe0\xb9\x91",
                                "\xf2" => "\xe0\xb9\x92",
                                "\xf3" => "\xe0\xb9\x93",
                                "\xf4" => "\xe0\xb9\x94",
                                "\xf5" => "\xe0\xb9\x95",
                                "\xf6" => "\xe0\xb9\x96",
                                "\xf7" => "\xe0\xb9\x97",
                                "\xf8" => "\xe0\xb9\x98",
                                "\xf9" => "\xe0\xb9\x99",
                                "\xfa" => "\xe0\xb9\x9a",
                                "\xfb" => "\xe0\xb9\x9b"));
}  

}

?>