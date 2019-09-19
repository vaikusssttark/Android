package test_app.vaikusstark.testingfeatures;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.Button;
import android.widget.ImageView;

public class MainActivity extends AppCompatActivity {

    ImageView bigIcon;
    ImageView smallIcon;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_main);

        bigIcon = findViewById(R.id.bigIcon);
        smallIcon = findViewById(R.id.smallIcon);
        Button btn = findViewById(R.id.button);

        Animation animRotateIn_icon = AnimationUtils.loadAnimation(this,
                R.anim.rotate);

        smallIcon.startAnimation(animRotateIn_icon);
        btn.startAnimation(animRotateIn_icon);
    }

    @Override
    protected void onResume() {
        super.onResume();
        Animation animRotateIn_big = AnimationUtils.loadAnimation(this,
                R.anim.rotate);
        bigIcon.startAnimation(animRotateIn_big);
    }
}
