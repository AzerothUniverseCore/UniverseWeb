<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_model extends CI_Model {

    /**
     * General_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getTimestamp()
    {
        $date = new DateTime();
        return $date->getTimestamp();
    }

    public function getMaintenance()
    {
        $config = $this->config->item('maintenance_mode');

        if($config == '1' && $this->wowauth->isLogged())
        {
            if($this->wowauth->getRank($this->session->userdata('wow_sess_id')) >= config_item('mod_access_level'))
                return true;
            else
                return false;
        }
        else
            return true;
    }

    public function getUserInfoGeneral($id)
    {
        return $this->db->select('*')->where('id', $id)->get('users');
    }

    public function getCharDPTotal($id)
    {
        $qq = $this->db->select('dp')->where('id', $id)->get('users');

        if ($qq->num_rows())
            return $qq->row('dp');
        else
            return '0';
    }

    public function getCharVPTotal($id)
    {
        $qq = $this->db->select('vp')->where('id', $id)->get('users');

        if ($qq->num_rows())
            return $qq->row('vp');
        else
            return '0';
    }

    public function getEmulatorAction()
    {
        $emulator = $this->config->item('emulator_legacy');

        if($emulator == true)
        {
            switch($emulator)
            {
                case true:
                    return "1";
                break;
            }
        }

    }

    public function getExpansionAction()
    {
        $expansion = $this->config->item('expansion');
        switch ($expansion)
        {
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
                return "1";
            break;
            case 6:
            case 7:
            case 8:
			case 9:
			case 10:
                return "2";
            break;
        }
    }

    public function getExpansionName()
    {
        $expansion = $this->config->item('expansion');
        switch ($expansion)
        {
            case 1:
                return "Vanilla";
                break;
            case 2:
                return "The Burning Crusade";
                break;
            case 3:
                return "Wrath of the lick King";
                break;
            case 4:
                return "Cataclysm";
                break;
            case 5:
                return "Mist of Pandaria";
                break;
            case 6:
                return "Warlords of Draenor";
                break;
            case 7:
                return "Legion";
                break;
            case 8:
                return "Battle of Azeroth";
                break;
            case 9:
                return "ShadowLands";
                break;
			case 10:
                return "Dragonflight";
                break;
        }
    }

    public function getMaxLevel()
    {
        $expansion = $this->config->item('expansion');
        switch ($expansion)
        {
            case 1:
                return "60";
                break;
            case 2:
                return "70";
                break;
            case 3:
                return "80";
                break;
            case 4:
                return "85";
                break;
            case 5:
                return "90";
                break;
            case 6:
                return "100";
                break;
            case 7:
                return "110";
                break;
            case 8:
                return "120";
                break;
            case 9:
                return "60";
                break;
			case 10:
                return "70";
                break;
        }
    }

    public function getRealExpansionDB()
    {
        $expansion = $this->config->item('expansion');
        switch ($expansion)
        {
            case 1:
                return "0";
                break;
            case 2:
                return "1";
                break;
            case 3:
                return "2";
                break;
            case 4:
                return "3";
                break;
            case 5:
                return "4";
                break;
            case 6:
                return "5";
                break;
            case 7:
                return "6";
                break;
            case 8:
                return "7";
                break;
            case 9:
                return "8";
                break;
			case 10:
                return "9";
                break;
        }
    }

    public function getRaceName($race)
    {
        switch ($race)
        {
            case 1:
                return $this->lang->line('race_human');
                break;
            case 2:
                return $this->lang->line('race_orc');
                break;
            case 3:
                return $this->lang->line('race_dwarf');
                break;
            case 4:
                return $this->lang->line('race_night_elf');
                break;
            case 5:
                return $this->lang->line('race_undead');
                break;
            case 6:
                return $this->lang->line('race_tauren');
                break;
            case 7:
                return $this->lang->line('race_gnome');
                break;
            case 8:
                return $this->lang->line('race_troll');
                break;
            case 9:
                return $this->lang->line('race_goblin');
                break;
            case 10:
                return $this->lang->line('race_blood_elf');
                break;
            case 11:
                return $this->lang->line('race_draenei');
                break;
            case 12:
                return $this->lang->line('race_worgen');
                break;
			case 13:
                return $this->lang->line('race_panda_horde');
                break;
            case 14:
                return $this->lang->line('race_panda_alli');
                break;
			case 15:
                return $this->lang->line('race_blood_elf_dh');
                break;
			case 16:
                return $this->lang->line('race_night_elf_dh');
                break;				
			case 17:
                return $this->lang->line('race_eredar');
                break;
			case 18:
                return $this->lang->line('race_void_elf');
                break;
			case 19:
                return $this->lang->line('race_vulpera');
                break;
			case 20:
                return $this->lang->line('race_nightborne');
                break;
			case 21:
                return $this->lang->line('race_lightforged_draenei');
                break;
			case 22:
                return $this->lang->line('race_zandalaritroll');
                break;
			case 23:
                return $this->lang->line('race_dark_iron_dwarf');
                break;
			case 24:
                return $this->lang->line('race_dark_iron_dwarf_h');
                break;
			case 25:
                return $this->lang->line('race_highelf');
                break;
            case 26:
                return $this->lang->line('race_highmountaintauren');
                break;
			case 27:
                return $this->lang->line('race_vulpera_a');
                break;
			case 28:
                return $this->lang->line('race_dracthyr_h');
                break;
			case 29:
                return $this->lang->line('race_dracthyr_a');
                break;
			case 30:
                return $this->lang->line('race_maghar');
                break;
			case 31:
                return $this->lang->line('race_kultiran');
                break;
        }
    }

    public function getRaceIcon($race)
    {
        switch ($race)
        {
            case 1:
                return 'human.png';
                break;
            case 2:
                return 'orc.png';
                break;
            case 3:
                return 'dwarf.png';
                break;
            case 4:
                return 'night_elf.png';
                break;
            case 5:
                return 'undead.png';
                break;
            case 6:
                return 'tauren.png';
                break;
            case 7:
                return 'gnome.png';
                break;
            case 8:
                return 'troll.png';
                break;
            case 9:
                return 'goblin.png';
                break;
            case 10:
                return 'blood_elf.png';
                break;
            case 11:
                return 'draenei.png';
                break;
            case 12:
                return 'worgen.png';
                break;
            case 13:
                return 'pandaren_male.png';
                break;
            case 14:
                return 'pandaren_male.png';
                break;
			case 15:
                return 'blood_elf_illidari.png';
                break;
			case 16:
                return 'night_elf_illidari.png';
                break;
			case 17:
                return 'eredar.png';
                break;
			case 18:
                return 'voidelf.png';
                break;
			case 19:
                return 'vulpera.png';
                break;
            case 20:
                return 'nightborne.png';
                break;
			case 21:
                return 'lightforged.png';
                break;
			case 22:
                return 'trollzandalari.png';
                break;
			case 23:
                return 'irondwarf.png';
                break;
			case 24:
                return 'irondwarf_h.png';
                break;
			case 25:
                return 'blood_elf.png';
                break;
            case 26:
                return 'highmountain.png';
                break;
            case 27:
                return 'vulpera_a.png';
                break;
			case 28:
                return 'visage_h.png';
                break;
			case 29:
                return 'visage_a.png';
                break;
			case 30:
                return 'magharorc.png';
                break;
			case 31:
                return 'kultiran.png';
                break;
        }
    }

    public function getClassIcon($race)
    {
        switch ($race)
        {
            case 1:
                return 'warrior.png';
                break;
            case 2:
                return 'paladin.png';
                break;
            case 3:
                return 'hunter.png';
                break;
            case 4:
                return 'rogue.png';
                break;
            case 5:
                return 'priest.png';
                break;
            case 6:
                return 'dk.png';
                break;
            case 7:
                return 'shaman.png';
                break;
            case 8:
                return 'mage.png';
                break;
            case 9:
                return 'warlock.png';
                break;
			case 10:
                return 'bbm.png';
                break;
			case 11:
                return 'druid.png';
                break;
			case 12:
                return 'knight.png';
                break;
			case 13:
                return 'demonhunter.png';
                break;
            case 14:
                return 'monk.png';
                break;
			case 15:
                return 'tamer.png';
                break;
			case 16:
                return 'heros.png';
                break;
			case 17:
                return 'evoker.png';
                break;
			case 18:
                return 'mancer.png';
                break;
			case 19:
                return 'mancer.png';
                break;
			case 20:
                return 'mancer.png';
                break;
			case 21:
                return 'mancer.png';
                break;
			case 22:
                return 'mancer.png';
                break;
			case 23:
                return 'chaosravager.png';
                break;
        }
    }

    public function getFaction($race)
    {
        switch ($race)
        {
            case '1': // Humain
            case '3': // Dwarf
            case '4': // Night Elf
            case '7': // Gnome
            case '11': // Draenei
            case '12': // Worgen
            case '14': // Pandaren alliance
			case '16': // Night Elf Illidari
            case '18': // Void Elf
            case '21': // Lightforged Draenei
            case '23': // Dark Iron Dwarf
            case '25': // Kul Tiran
			case '27': // Mechagnome
			case '29': // Elfe de sang
			case '31': // Fallen
                return 'Alliance';
            break;
            case '2': // Orc
            case '5': // Undead
            case '6': // Tauren
            case '8': // Troll
            case '9': // Goblin
            case '10': // Blood Elf
            case '13': // Pandaren horde
			case '15': // Blood Elf Illidari
            case '17': // Eredar
            case '19': // Vulpera
            case '20': // Nightborne
            case '22': // Zandalari Troll
			case '24': // Orc Mag'har
			case '26': // Highmountain Tauren
			case '28': // Humain
			case '30': // Fallen
                return 'Horde';
            break;
        }
    }

    public function getClassName($class)
    {
        switch ($class)
        {
            case 1:
                return $this->lang->line('class_warrior');
                break;
            case 2:
                return $this->lang->line('class_paladin');
                break;
            case 3:
                return $this->lang->line('class_hunter');
                break;
            case 4:
                return $this->lang->line('class_rogue');
                break;
            case 5:
                return $this->lang->line('class_priest');
                break;
            case 6:
                return $this->lang->line('class_dk');
                break;
            case 7:
                return $this->lang->line('class_shamman');
                break;
            case 8:
                return $this->lang->line('class_mage');
                break;
            case 9:
                return $this->lang->line('class_warlock');
                break;
			case 10:
                return $this->lang->line('class_bbm');
                break;
			case 11:
                return $this->lang->line('class_druid');
                break;
			case 12:
                return $this->lang->line('class_knight');
                break;
			case 13:
                return $this->lang->line('class_demonhunter');
                break;
            case 14:
                return $this->lang->line('class_monk');
                break;
			case 15:
                return $this->lang->line('class_tamer');
                break;
			case 16:
                return $this->lang->line('class_hero');
                break;
			case 17:
                return $this->lang->line('class_evoker');
                break;
			case 18:
                return $this->lang->line('class_necromancer');
                break;
			case 19:
                return $this->lang->line('class_venomancer');
                break;
			case 20:
                return $this->lang->line('class_pyromancer');
                break;
			case 21:
                return $this->lang->line('class_chronomancer');
                break;
			case 22:
                return $this->lang->line('class_geomancer');
                break;
			case 23:
                return $this->lang->line('class_chaosravager');
                break;
        }
    }

    public function getGender($gender)
    {
        switch ($gender)
        {
            case 0:
                return $this->lang->line('gender_male');
                break;
            case 1:
                return $this->lang->line('gender_female');
                break;
        }
    }

    public function getSpecifyZone($zoneid)
    {
        $qq = $this->db->select('zone_name')->where('id', $zoneid)->get('zonesfr');

        if($qq->num_rows())
            return $qq->row('zone_name');
        else
            return 'Unknown Zone';
    }

    public function moneyConversor($amount)
    {
        $gold = substr($amount, 0, -4);
        $silver = substr($amount, -4, -2);
        $copper = substr($amount, -2);

        if ($gold == 0)
            $gold = 0;

        if ($silver == 0)
            $silver = 0;

        if ($copper == 0)
            $copper = 0;

        $money = array(
            'gold' => $gold,
            'silver' => $silver,
            'copper' => $copper
        );

        return $money;
    }

    public function timeConversor($time)
    {
        $dateF = new DateTime('@0');
        $dateT = new DateTime("@$time");
        return $dateF->diff($dateT)->format('%aD %hH %iM %sS');
    }

    public function tinyEditor($rank)
    {
        switch ($rank) {
            case 'Admin':
                return "<script src=".base_url('assets/core/tinymce/tinymce.min.js')."></script>
                        <script>tinymce.init({selector: '.tinyeditor',element_format : 'html',menubar: true,
                            plugins: ['preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media codesample table charmap hr insertdatetime advlist lists wordcount imagetools textpattern help'],
                            toolbar: 'undo redo | fontsizeselect | bold italic strikethrough | forecolor backcolor | link emoticons image media | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat'});
                        </script>";
                break;
            case 'User':
                return "<script src=".base_url('assets/core/tinymce/tinymce.min.js')."></script>
                        <script>tinymce.init({selector: '.tinyeditor',element_format : 'html',menubar: false,
                            plugins: ['advlist autolink lists link image charmap textcolor searchreplace fullscreen media paste wordcount emoticons'],
                            toolbar: 'undo redo | fontsizeselect | bold italic strikethrough | forecolor | link emoticons image | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat'});
                        </script>";
                break;
        }
    }

    public function smtpSendEmail($to, $subject, $message)
    {
        $this->load->library('email');

        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => $this->config->item('smtp_host'),
            'smtp_user' => $this->config->item('smtp_user'),
            'smtp_pass' => $this->config->item('smtp_pass'),
            'smtp_port' => $this->config->item('smtp_port'),
            'smtp_crypto' => $this->config->item('smtp_crypto'),
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        $this->email->to($to);
        $this->email->from($this->config->item('email_settings_sender'), $this->config->item('email_settings_sender_name'));
        $this->email->subject($subject);
        $this->email->message($message);

        return $this->email->send();
    }

    public function getMenu()
    {
        return $this->db->select('*')->get('menufr');
    }

    public function getMenuChild($id)
    {
        return $this->db->select('*')->where('child', $id)->get('menufr');
    }
}
