<div class="input-group mt-5"><textarea name="<?php echo $module_input_slug_lang; ?>" class="pl-0 border-top-0 border-left-0 border-right-0 rounded-0 form-control" placeholder="<?php echo ($module_input_placeholder?$module_input_placeholder:ucfirst($types[$type]['name']).' '.$module_input_slug_lang); ?>" id="<?php echo $module_input_slug_lang; ?>"><?php echo ($post[$module_input_slug_lang]?$post[$module_input_slug_lang]:$module_input_default_value); ?></textarea><?php echo ($module_input_placeholder?'<div class="col-12 row text-muted small m-0"><span class="ml-auto mr-0">'.$module_input_placeholder.'</span></div>':''); ?></div>