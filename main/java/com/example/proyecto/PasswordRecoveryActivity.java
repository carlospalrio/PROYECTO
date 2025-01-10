package com.example.proyecto;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class PasswordRecoveryActivity extends AppCompatActivity {

    private EditText etRecoveryEmail;
    private Button btnRecover, btnBackToLogin;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_password_recovery);

        // Inicialización de vistas
        etRecoveryEmail = findViewById(R.id.etRecoveryEmail);
        btnRecover = findViewById(R.id.btnRecover);
        btnBackToLogin = findViewById(R.id.btnBackToLogin);

        // Listener para enviar correo de recuperación
        btnRecover.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String email = etRecoveryEmail.getText().toString().trim();

                if (!email.isEmpty()) {

                    Toast.makeText(PasswordRecoveryActivity.this, "Recovery email sent", Toast.LENGTH_SHORT).show();
                } else {
                    Toast.makeText(PasswordRecoveryActivity.this, "Please enter your email", Toast.LENGTH_SHORT).show();
                }
            }
        });

        // Listener para regresar al Login
        btnBackToLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(PasswordRecoveryActivity.this, LoginActivity.class);
                startActivity(intent);
                finish(); // Cierra la actividad actual
            }
        });
    }
}
