<?php 

    function OPTIONPROVINCE()
    {
       $ci =& get_instance() ;       
       $text = '
        <select class="form-control" style="width: 103%;" name="province" >
            <option value="ID-AC">Nangroe Aceh Darussalam</option>
          <option value="ID-SU">Sumatera Utara</option>
          <option value="ID-SB">Sumatera Barat</option>
          <option value="ID-RI">Riau</option>
          <option value="ID-KR">Kepulauan Riau</option>
          <option value="ID-JA">Jambi</option>
          <option value="ID-SS">Sumatera Selatan</option>
          <option value="ID-BE">Bengkulu</option>
          <option value="ID-LA">Lampung</option>
          <option value="ID-BB">Bangka Belitung</option>
          <option value="ID-JK">DKI Jakarta</option>
          <option value="ID-JB">Jawa Barat</option>
          <option value="ID-BT">Banten</option>
          <option value="ID-JT">Jawa Tengah</option>
          <option value="ID-YO">DI Yogyakarta</option>
          <option value="ID-JI">Jawa Timur</option>
          <option value="ID-BA">Bali</option>
          <option value="ID-NB">Nusa Tenggara Barat</option>
          <option value="ID-NT">Nusa Tenggara Timur</option>
          <option value="ID-KB">Kalimantan Barat</option>
          <option value="ID-KT">Kalimantan Tengah</option>
          <option value="ID-KS">Kalimantan Selatan</option>
          <option value="ID-KI">Kalimantan Timur</option>
          <option value="ID-KU">Kalimantan Utara</option>
          <option value="ID-SA">Sulawesi Utara</option>
          <option value="ID-GO">Gorontalo</option>
          <option value="ID-ST">Sulawesi Tengah</option>
          <option value="ID-SN">Sulawesi Selatan</option>
          <option value="ID-SR">Sulawesi Barat</option>
          <option value="ID-SG">Sulawesi Tenggara</option>
          <option value="ID-MA">Maluku</option>
          <option value="ID-MU">Maluku Utara</option>
          <option value="ID-PA">Papua</option>
          <option value="ID-PB">Papua Barat</option>
          </select>
        </div>   ';


      return  $text;

    }





?>