package test_app.vaikusstark.testingfeatures;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import test_app.vaikusstark.testingfeatures.requests.SuccessResponse;
import test_app.vaikusstark.testingfeatures.requests.User;

public class MainActivity extends AppCompatActivity {


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        Button btn = findViewById(R.id.button);
        btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                DBHelper.getInstance()
                        .getTesterAPI()
                        .updateUserPassword(1, "qwerty@asdf@")
                        .enqueue(new Callback<SuccessResponse>() {
                            @Override
                            public void onResponse(@NonNull Call<SuccessResponse> call, @NonNull Response<SuccessResponse> response) {
                                SuccessResponse successResponse = response.body();
                                assert successResponse != null;
                                System.out.println(successResponse.getSuccess());
                                System.out.println(successResponse.getMessage());
                            }

                            @Override
                            public void onFailure(@NonNull Call<SuccessResponse> call, @NonNull Throwable t) {
                                System.out.println("Internet connection error");
                                t.printStackTrace();
                            }
                        });
            }
        });

    }
}
