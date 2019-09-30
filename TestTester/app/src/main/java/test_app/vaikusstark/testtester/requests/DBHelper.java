package test_app.vaikusstark.testtester.requests;

import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class DBHelper {
    private static DBHelper mInstance;
    private static final String URL_BASE = "http://a0339016.xsph.ru/";
    private Retrofit mRetrofit;

    private DBHelper() {
        mRetrofit = new Retrofit.Builder()
                .baseUrl(URL_BASE)
                .addConverterFactory(GsonConverterFactory.create())
                .build();
    }

    public static DBHelper getInstance() {
        if (mInstance == null) {
            mInstance = new DBHelper();
        }
        return mInstance;
    }

    public TestTesterAPI getTesterAPI() {
        return mRetrofit.create(TestTesterAPI.class);
    }
//    DBHelper.getInstance()
//            .getTesterAPI()
//            .getAllUsers()
//            .enqueue(new Callback<Users>() {
//                  @Override
//                  public void onResponse(@NonNull Call<Users> call, @NonNull Response<Users> response) {
//                      Users users = response.body();
//                      System.out.println(Arrays.toString(users.getUserArray()));
//                      System.out.println(users.getUserArray()[0]);
//                  }
//
//                  @Override
//                  public void onFailure(@NonNull Call<Users> call, @NonNull Throwable t) {
//                      System.out.println("Internet connection error");
//                      t.printStackTrace();
//                  }
//    });
}

