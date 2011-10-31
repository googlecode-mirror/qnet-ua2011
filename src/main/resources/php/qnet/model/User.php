<?php

namespace Qnet\Model;

class User {

	public static $AGE = "AGE";
	public static $GENDER = "GENDER";
	public static $MARITAL_STATUS = "MARTIAL_STATUS";
	public static $STUDIES = "STUDIES";
	public static $LOCATION = "LOCATION";
	public static $RELIGION = "RELIGION";
	public static $PROPERTIES;
	public static $PROPS_LABELS;

    public static $FIRST_PROPERTY;

	public static function init() {
		User::$PROPERTIES = array(User::$AGE => array("Young", "Adult", "Old"),
						User::$GENDER => array("Male", "Female"),
						User::$MARITAL_STATUS => array("Single", "Married", "Divorced", "Widow"),
						User::$STUDIES => array("Primary", "Secondary", "University"),
						User::$LOCATION => array("Argentina", "Brazil"),
						User::$RELIGION => array("Catholic", "Musulman"));
        User::$FIRST_PROPERTY = User::$AGE;
		User::$PROPS_LABELS = array(User::$AGE => "Age",
						User::$GENDER => "Gender",
						User::$MARITAL_STATUS => "Marital status",
						User::$STUDIES => "Studies",
						User::$LOCATION => "Current country location",
						User::$RELIGION => "Religion");
	}

	public static function indexOfUserValue($property, $user) {
		return User::indexOfValue($property, User::getUserValue($property, $user));
	}

	public static function createPropertyMap($defaultValue) {
		$result = array();
		foreach(array_keys(User::$PROPERTIES) as $prop) {
			$result[$prop] = $defaultValue;
		}
		return $result;
	}

	private static function getUserValue($varValue, $user) {
		switch($varValue) {
			case User::$AGE:
				return $user->birth;
			case User::$GENDER:
				return $user->gender;
			case User::$MARITAL_STATUS:
				return $user->maritalSt;
			case User::$STUDIES:
				return $user->studies;
			case User::$LOCATION:
				return $user->country;
			case User::$RELIGION:
				return $user->religion;
		}
	}

	public static function readProperties($user, $values) {
		if($values[User::$AGE] != null) {
			return $user->birth = $values[User::$AGE];
		}
		$user->gender = $values[User::$GENDER];
		$user->maritalSt = $values[User::$MARITAL_STATUS];
		$user->studies = $values[User::$STUDIES];
		$user->country = $values[User::$LOCATION];
		$user->religion = $values[User::$RELIGION];
	}

    public static function indexOfSelectValue($property, $value) {
        return array_search($value, User::$PROPERTIES[$property]);
    }

	public static function indexOfValue($property, $value) {
		if($property == User::$AGE) {
			$age = 2010 - intval(substr($value, strrpos($value, '-') + 1));
			if($age < 18) return 0;
			if($age < 60) return 1;
			return 2;
		}
		return array_search($value, User::$PROPERTIES[$property]);
	}

	public static function propertyValueAt($property, $ix) {
		User::$PROPERTIES[$property][$x];
	}

	public static function propertyValues($property) {
		return User::$PROPERTIES[$property];
	}

	public static function getPropertyCardinality($property) {
	    return count(User::$PROPERTIES[$property]);
	}

    public static function printSimpleOptionsFor($property) {
        foreach(User::$PROPERTIES[$property] as $value) {
            User::outputOption($property, $value, null, true);
        }
    }

    public static function printOptionsFor($property, $default = null) {
        echo '<label class="mylabelstyle">'.User::$PROPS_LABELS[$property].'</label>';
        User::_printOptionsFor($property, $default);
    }

    private static function _printOptionsFor($property, $default) {
		if($property == User::$GENDER) {
			foreach(User::$PROPERTIES[$property] as $value) {
				User::outputOption($property, $value, $default);
			}
		} else {
			echo '<select id="'.$property.'" name="'.$property.'">';
			foreach(User::$PROPERTIES[$property] as $value) {
				User::outputOption($property, $value, $default);
			}
			echo '</select>';
		}
	}

	public static function printPropertiesOptions() {
		foreach(User::$PROPS_LABELS as $value => $label) {
			User::outputCustomOption($value, $label, null);
		}
	}

	private static function outputOption($name, $value, $default, $forceSelect = false) {
		if($name == User::$GENDER && !$forceSelect) {
	        echo '<label for="'.$name.$value.'">'.$value.'</label>';
	        echo '<input type="radio" name="'.$name.'" value="'.$value.'" id="'.$name.$value.'" ';
			User::check($default, $value);
			echo ' />';
		} else {
			User::outputCustomOption($value, $value, $default);
		}
	}

	private static function outputCustomOption($value, $label, $default) {
		echo '<option ';
		User::sel($default, $value);
		echo ' value="'.$value.'">'.$label.'</option>';
	}

    private static function check($var, $value) {
        if($var == $value) {
            echo 'checked="checked"';
        }
    }

    private static function sel($var, $value) {
        if($var == $value) {
            echo 'selected="selected"';
        }
    }

    public $id;
    public $name;
    public $lastName;
    public $mail;
    public $password;
    public $birth;
    public $gender;
    public $maritalSt;
    public $studies;
    public $InstitutionName;
    public $country;
    public $religion;
    public $photo;
    public $alive;

    //religion , country

    public function getId() {
        return $this->id;
    }

    public function setReligion($religion) {
        $this->religion = $religion;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function getReligion() {
        return $this->religion;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setInstitutionName($institutionName) {
        $this->InstitutionName = $institutionName;
    }

    public function getInstitutionName() {
        return $this->InstitutionName;
    }

    public function getLastName() {

        return $this->lastName;
    }

    public function setLastName($lastName) {

        $this->lastName = $lastName;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    function __construct($name, $lastName, $mail, $password, $birth, $gender, $maritalSt, $studies, $InstitutionName, $country, $religion, $photo='img08', $alive = 1) {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->mail = $mail;
        $this->password = $password;
        $this->birth = $birth;
        $this->gender = $gender;
        $this->maritalSt = $maritalSt;
        $this->studies = $studies;
        $this->InstitutionName = $InstitutionName;
        $this->country = $country;
        $this->religion = $religion;
        $this->photo = $photo;
        $this->alive = $alive;
    }

    public function getName() {
        return $this->name;
    }

    public function setAlive($alive) {
        $this->alive = $alive;
    }

    public function getPhoto() {
        return $this->photo;
    }

}

User::init();

?>