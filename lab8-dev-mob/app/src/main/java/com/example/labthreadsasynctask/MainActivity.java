package com.example.labthreadsasynctask;

import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

public class MainActivity extends AppCompatActivity {

    // Références vers l’interface
    private TextView txtStatus;
    private ProgressBar progressBar;
    private ImageView img;

    // Handler lié au UI thread
    private Handler mainHandler;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // Lier les vues XML
        txtStatus = findViewById(R.id.txtStatus);
        progressBar = findViewById(R.id.progressBar);
        img = findViewById(R.id.img);

        Button btnLoadThread = findViewById(R.id.btnLoadThread);
        Button btnCalcAsync = findViewById(R.id.btnCalcAsync);
        Button btnToast = findViewById(R.id.btnToast);

        // Handler pour revenir au UI thread
        mainHandler = new Handler(Looper.getMainLooper());

        // Bouton Toast
        btnToast.setOnClickListener(v ->
                Toast.makeText(getApplicationContext(),
                        "UI réactive", Toast.LENGTH_SHORT).show()
        );

        // Charger image avec Thread
        btnLoadThread.setOnClickListener(v -> loadImageWithThread());

        // Calcul lourd avec AsyncTask
        btnCalcAsync.setOnClickListener(v -> new HeavyCalcTask().execute());
    }

    // ---------------------------------
    // THREAD
    // ---------------------------------
    private void loadImageWithThread() {

        progressBar.setVisibility(View.VISIBLE);
        progressBar.setProgress(0);
        txtStatus.setText("Statut : chargement image (Thread)...");

        new Thread(() -> {

            try {
                Thread.sleep(1000);
            } catch (InterruptedException e) {
                e.printStackTrace();
            }

            Bitmap bitmap = BitmapFactory.decodeResource(
                    getResources(),
                    R.drawable.ic_launcher_foreground
            );

            mainHandler.post(() -> {

                img.setImageBitmap(bitmap);
                progressBar.setVisibility(View.INVISIBLE);
                txtStatus.setText("Statut : image chargée (Thread)");

            });

        }).start();
    }

    // ---------------------------------
    // ASYNCTASK
    // ---------------------------------
    private class HeavyCalcTask extends AsyncTask<Void, Integer, Long> {

        @Override
        protected void onPreExecute() {

            progressBar.setVisibility(View.VISIBLE);
            progressBar.setProgress(0);
            txtStatus.setText("Statut : calcul lourd (AsyncTask)...");
        }

        @Override
        protected Long doInBackground(Void... voids) {

            long result = 0;

            for (int i = 1; i <= 100; i++) {

                for (int k = 0; k < 200000; k++) {
                    result += (i * k) % 7;
                }

                publishProgress(i);
            }

            return result;
        }

        @Override
        protected void onProgressUpdate(Integer... values) {

            progressBar.setProgress(values[0]);
        }

        @Override
        protected void onPostExecute(Long result) {

            progressBar.setVisibility(View.INVISIBLE);
            txtStatus.setText("Statut : calcul terminé résultat = " + result);
        }
    }
}