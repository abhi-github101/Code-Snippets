#include <iostream>
#include <string>

using namespace std;

int main(){
    string str;
    cin >> str;

    string ch;
    int exists=0;
    for(int i=0;i<str.length();i++){
        for (int j=0;j<ch.length();j++){
            if(ch[j]==str[i]){
                exists=1;
            }
        }
        if(!exists){
            ch+=str[i];
        }
        exists=0;
    }
    cout << ch << endl;
}

