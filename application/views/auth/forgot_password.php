<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-xl shadow-lg">
        <!-- Header -->
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">
                <?php echo lang('forgot_password_heading');?>
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                <?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?>
            </p>
        </div>

        <!-- Error Message -->
        <?php if($message): ?>
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-700"><?php echo $message;?></p>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Form -->
        <?php echo form_open("auth/forgot_password", ['class' => 'mt-8 space-y-6']);?>
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="identity" class="block text-sm font-medium text-gray-700 mb-2">
                        <?php 
                        echo (($type == 'email') 
                            ? sprintf(lang('forgot_password_email_label'), $identity_label) 
                            : sprintf(lang('forgot_password_identity_label'), $identity_label)); 
                        ?>
                    </label>
                    <?php 
                    $input_attributes = array(
                        'class' => 'appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm',
                        'placeholder' => 'Enter your email address'
                    );
                    echo form_input($identity, '', $input_attributes);
                    ?>
                </div>
            </div>

            <div>
                <?php 
                $submit_attributes = array(
                    'class' => 'group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500',
                    'type' => 'submit'
                );
                echo form_submit('submit', lang('forgot_password_submit_btn'), $submit_attributes);
                ?>
            </div>
        <?php echo form_close();?>

        <!-- Back to Login Link -->
        <div class="text-center mt-4">
            <a href="<?php echo site_url('auth/login'); ?>" class="text-sm text-blue-600 hover:text-blue-500">
                Back to Login
            </a>
        </div>
    </div>
</body>
</html>