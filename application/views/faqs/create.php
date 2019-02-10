<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('faqs/create'); ?>
    <table>
        <tr>
            <td><label for="title">Title</label></td>
            <td><input type="input" name="title" /></td>
        </tr>
        
        <tr>
            <td><label for="text">Text</label></td> 
            <td><textarea name="text"></textarea></td>
        </tr>

        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Create faqs item" /></td>
        </tr>
    </table>
</form>