<table class="form-table">
    <tbody>
        <tr>
            <th scope="row">
                <label for="slider_subtitle">Sub Title</label>
            </th>
            <td><input name="slider_subtitle" type="text" id="slider_subtitle" value="<?php echo isset($slidermeta['slider_subtitle']) ? $slidermeta['slider_subtitle'][0] : ''; ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th scope="row">
                <label for="slider_btn_text">Button Text</label>
            </th>
            <td><input name="slider_btn_text" type="text" id="slider_btn_text" value="<?php echo isset($slidermeta['slider_btn_text']) ? $slidermeta['slider_btn_text'][0] : ''; ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th scope="row">
                <label for="slider_btn_link">Button Link</label>
            </th>
            <td><input name="slider_btn_link" type="text" id="slider_btn_link" value="<?php echo isset($slidermeta['slider_btn_link']) ? $slidermeta['slider_btn_link'][0] : ''; ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th scope="row">
                <label for="slider_description">Description</label>
            </th>
            <td>
                <textarea name="slider_description" id="slider_description" class="large-text code" rows="10"><?php echo isset($slidermeta['slider_description']) ? $slidermeta['slider_description'][0] : ''; ?></textarea>
            </td>
        </tr>
    </tbody>
</table>