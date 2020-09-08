#include <iostream>
#include <string>

using namespace std;

int main(){
    int lines;
    cin >> lines;

    string sentence[lines];
    string words[lines][20];
    int count=0;

    for (int i=0;i<lines;i++){
        getline(cin, sentence[i]);
        for(int j=0;j<sentence[i].length();j++){
            if(sentence[i][j]==' '){
                count++;
            }
            else{
                words[i][count]+=sentence[i][j];
            }
        }
        for (int j=count;j>=0;j--){
            cout << words[i][j]<<" ";
        }
        cout<< endl;
    }
}
