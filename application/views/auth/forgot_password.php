<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <style>
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .animate-gradient {
            background: linear-gradient(-45deg, #3b82f6, #4f46e5, #2563eb, #1e40af);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        .glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>

<body class="h-full bg-gradient-to-br from-blue-50 to-white">
    <div class="min-h-screen flex flex-col items-center justify-center p-4">
        <div class="w-full max-w-md">
            <!-- Header with Icon -->
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-blue-600 rounded-2xl mx-auto flex items-center justify-center animate-float mb-6">
                    <i class="fas fa-key text-white text-4xl"></i>
                </div>
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 mb-2">
                    <?php echo lang('forgot_password_heading');?>
                </h2>
                <p class="text-gray-600">
                    <?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?>
                </p>
            </div>

            <!-- Main Card -->
            <div class="glass rounded-2xl p-8 shadow-xl mb-8">
                <!-- Error Message -->
                <?php if($message): ?>
                <div class="mb-6 bg-red-50 rounded-xl border-l-4 border-red-500 p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-400 mt-0.5"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700"><?php echo $message;?></p>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Form -->
                <?php echo form_open("auth/forgot_password", ['class' => 'space-y-6']);?>
                    <div>
                        <label for="identity" class="block text-sm font-medium text-gray-700 mb-2">
                            <?php echo (($type == 'email') 
                                ? sprintf(lang('forgot_password_email_label'), $identity_label) 
                                : sprintf(lang('forgot_password_identity_label'), $identity_label)); ?>
                        </label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <?php 
                            $input_attributes = array(
                                'class' => 'block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-900 placeholder-gray-500 transition-colors',
                                'placeholder' => 'Enter your email address'
                            );
                            echo form_input($identity, '', $input_attributes);
                            ?>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-[1.02]">
                            <i class="fas fa-paper-plane mr-2"></i>
                            <?php echo lang('forgot_password_submit_btn'); ?>
                        </button>
                    </div>
                <?php echo form_close();?>
            </div>

            <!-- Back to Login Link -->
            <div class="text-center space-y-4">
                <a href="<?php echo site_url('auth/login'); ?>" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-500 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Login
                </a>
                <div class="text-gray-500 text-sm flex items-center justify-center">
                    <i class="fas fa-shield-alt mr-2 text-green-500"></i>
                    Your information is secure with us
                </div>
            </div>
        </div>
    </div>
</body>
</html>