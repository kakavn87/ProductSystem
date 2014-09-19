<?php echo $error;?>

<?php echo form_open_multipart('upload/do_upload/'.$path.'/'.$id);?>

<input type="file" name="userfile" size="20" />
<span>Maximale Breite: 210px</span>

<br /><br />

<input type="submit" value="Bild hochladen" />

</form>
