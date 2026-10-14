package com.example.wachmziaan.ui

import android.Manifest
import android.content.Intent
import android.content.pm.PackageManager
import android.os.Bundle
import android.util.Log
import android.widget.Button
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.core.app.ActivityCompat
import androidx.core.content.ContextCompat
import androidx.lifecycle.ViewModelProvider
import com.example.wachmziaan.R
import com.example.wachmziaan.api.RetrofitClient
import com.example.wachmziaan.viewmodel.ProductViewModel
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import kotlinx.coroutines.withContext

class MainActivity : AppCompatActivity() {

    companion object {
        private const val CAMERA_PERMISSION_CODE = 100
    }

    private val TAG = "MainActivity"
    private lateinit var viewModel: ProductViewModel
    private val coroutineScope = CoroutineScope(Dispatchers.Main)

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        // Initialisation du ViewModel
        viewModel = ViewModelProvider(this)[ProductViewModel::class.java]

        val btnScan = findViewById<Button>(R.id.btnScan)
        // val btnTestApi = findViewById<Button>(R.id.btnTestApi)

        btnScan.setOnClickListener {
            if (checkCameraPermission()) {
                openScanner()
            } else {
                requestCameraPermission()
            }
        }

        // btnTestApi.setOnClickListener {
        //     testApiConnection()
        // }
    }

    private fun checkCameraPermission(): Boolean {
        return ContextCompat.checkSelfPermission(
            this,
            Manifest.permission.CAMERA
        ) == PackageManager.PERMISSION_GRANTED
    }

    private fun requestCameraPermission() {
        ActivityCompat.requestPermissions(
            this,
            arrayOf(Manifest.permission.CAMERA),
            CAMERA_PERMISSION_CODE
        )
    }

    override fun onRequestPermissionsResult(
        requestCode: Int,
        permissions: Array<String>,
        grantResults: IntArray
    ) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults)

        if (requestCode == CAMERA_PERMISSION_CODE) {
            if (grantResults.isNotEmpty() && grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                openScanner()
            } else {
                Toast.makeText(this, "Permission caméra refusée", Toast.LENGTH_SHORT).show()
            }
        }
    }

    private fun openScanner() {
        val intent = Intent(this, ScannerActivity::class.java)
        startActivity(intent)
    }

    private fun testApiConnection() {
        showToast("Test de connexion à l'API en cours...")

        coroutineScope.launch {
            try {
                val response: String = withContext(Dispatchers.IO) {
                    RetrofitClient.apiService.testConnection()
                }
                val message = "Connexion réussie: $response"
                Log.d(TAG, message)
                showToast(message)
            } catch (e: Exception) {
                val error = "Échec de la connexion: ${e.message}"
                Log.e(TAG, error, e)
                showToast(error)
            }
        }
    }

    private fun showToast(message: String) {
        Toast.makeText(this, message, Toast.LENGTH_LONG).show()
    }
}