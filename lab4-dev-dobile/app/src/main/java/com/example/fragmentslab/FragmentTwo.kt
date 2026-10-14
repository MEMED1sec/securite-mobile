package com.example.fragmentslab

import android.os.Bundle
import android.view.View
import android.widget.SeekBar
import android.widget.TextView
import androidx.fragment.app.Fragment

class FragmentTwo : Fragment(R.layout.fragment_two) {

    private lateinit var tvValue: TextView
    private lateinit var seek: SeekBar
    private var progress = 0

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)

        tvValue = view.findViewById(R.id.tvValue)
        seek = view.findViewById(R.id.seekBar)

        if (savedInstanceState != null) {
            progress = savedInstanceState.getInt("progress", 0)
            seek.progress = progress
            tvValue.text = "Valeur : $progress"
        }

        seek.setOnSeekBarChangeListener(object : SeekBar.OnSeekBarChangeListener {
            override fun onProgressChanged(seekBar: SeekBar?, p: Int, fromUser: Boolean) {
                progress = p
                tvValue.text = "Valeur : $p"
            }

            override fun onStartTrackingTouch(seekBar: SeekBar?) {}
            override fun onStopTrackingTouch(seekBar: SeekBar?) {}
        })
    }

    override fun onSaveInstanceState(outState: Bundle) {
        super.onSaveInstanceState(outState)
        outState.putInt("progress", progress)
    }
}