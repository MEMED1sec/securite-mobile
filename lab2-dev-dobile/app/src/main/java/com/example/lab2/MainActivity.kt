package com.example.lab2

import android.os.Bundle
import android.widget.Button
import android.widget.CheckBox
import android.widget.EditText
import android.widget.TextView
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity

class MainActivity : AppCompatActivity() {

    private lateinit var surfaceInput: EditText
    private lateinit var piecesInput: EditText
    private lateinit var piscineCheckbox: CheckBox
    private lateinit var resultView: TextView
    private lateinit var calculButton: Button

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        surfaceInput = findViewById(R.id.input_surface)
        piecesInput = findViewById(R.id.input_pieces)
        piscineCheckbox = findViewById(R.id.checkbox_piscine)
        resultView = findViewById(R.id.result)
        calculButton = findViewById(R.id.button_calcul)

        calculButton.setOnClickListener {
            calculerImpot()
        }
    }

    private fun calculerImpot() {
        val surfaceText = surfaceInput.text.toString().trim()
        val piecesText = piecesInput.text.toString().trim()

        if (surfaceText.isEmpty() || piecesText.isEmpty()) {
            Toast.makeText(this, "Veuillez remplir tous les champs", Toast.LENGTH_SHORT).show()
            return
        }

        val surface = surfaceText.toDouble()
        val pieces = piecesText.toInt()
        val piscine = piscineCheckbox.isChecked

        val impotBase = surface * 2
        val impotSupplementaire = (pieces * 50) + if (piscine) 100 else 0
        val impotTotal = impotBase + impotSupplementaire

        val resultat = "Impôt de base : $impotBase DH\n" +
                "Impôt supplémentaire : $impotSupplementaire DH\n" +
                "Impôt Total : $impotTotal DH"

        resultView.text = resultat
    }
}