<?php

class GendersController
{

	public function gendersSelect($selectedGender)
	{
		$genders = GendersModel::genders();

		foreach ($genders as $gender) {
			$selected = $gender['id_gender'] == $selectedGender ? 'selected' : '';
			echo '<option value="' . $gender['id_gender'] . '" ' . $selected . '>' . $gender['details'] . '</option>';
		}
	}

	public function allGendersSelect()
	{

		$genders = GendersModel::genders();

		foreach ($genders as $key => $value) {
			echo '<option value="' . $value['id_gender'] . '">' . $value['details'] . '</option>';
		}
	}

}
