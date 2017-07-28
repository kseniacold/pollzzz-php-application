<div id="poll-wrapper" class="modal poll-form__container">
	<form id="poll-form" class="modal poll-form">
	    <div class="field">
	        <label class="field__lbl">Title:</label>
	        <input required class="field__input" name="poll-name" type="text" maxlength="250">
	    </div>
	    <div class="field">
	        <label class="field__lbl">Description:</label>
	        <textarea class="field__textarea" rows="6" name="poll-description" type="text" maxlength="500"></textarea>
	    </div>
	    <div class="field">
	        <label class="field__lbl">Duration:</label>
	        <fieldset class="field__group">
	            <input class="field__input inline" name="poll-duration-days" type="number" step="1" min="0">
	            <span class="field__details">days</span>
	        </fieldset>
	        <fieldset class="field__group">
	            <input class="field__input inline" name="poll-duration-hrs" type="text">
	            <span class="field__details">hours</span>
	        </fieldset>
	        <fieldset class="field__group">
	            <input class="field__input inline" name="poll-duration-mins" type="number" step="1" min="0" max="59">
	            <span class="field__details">minutes</span>
	        </fieldset>
	        <div class="btn__wrapper">
	            <input class="btn" name="submit" type="submit" value="Create Poll">
	        </div>
	    </div>
	</form>
</div>
