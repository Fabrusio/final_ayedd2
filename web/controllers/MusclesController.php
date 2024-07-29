<?php

class MusclesController
{

	public function muscleSelect($selectedMuscle)
	{
		$muscles = MusclesModel::muscles();

		foreach ($muscles as $muscle) {
			$selected = $muscle['id_muscle'] == $selectedMuscle ? 'selected' : '';
			echo '<option value="' . $muscle['id_muscle'] . '" ' . $selected . '>' . $muscle['details'] . '</option>';
		}
	}

	public function allGendersSelect()
	{

		$muscles = MusclesModel::muscles();

		foreach ($muscles as $key => $value) {
			echo '<option value="' . $value['id_muscle'] . '">' . $value['details'] . '</option>';
		}
	}

}

?>